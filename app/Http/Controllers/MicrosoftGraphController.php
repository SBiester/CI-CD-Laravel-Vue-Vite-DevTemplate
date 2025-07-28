<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use App\Services\MicrosoftGraphService;
use Microsoft\Graph\Model;
use Microsoft\Graph\Core\Authentication\GraphPhpLeagueAuthenticationProvider;
use Microsoft\Kiota\Abstractions\ApiException;
use Microsoft\Kiota\Authentication\Oauth\ClientCredentialContext;
use Microsoft\Graph\GraphServiceClient;
//use Microsoft\Graph\Http\GraphRequest;
use Microsoft\Graph\Core\GraphConstants;
use Microsoft\Graph\Core\GraphConfig;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Authentication\TokenStore\TokenCacheInterface;
use Microsoft\Graph\Authentication\Provider\Bearer;
use Microsoft\Graph\Authentication\Provider\JWT;
use Microsoft\Graph\GraphException;
use Microsoft\Graph\Http\GraphResponse;
use Microsoft\Graph\Http\GraphRequestOptions;
use Microsoft\Graph\Authentication\Provider\MultiTenantAuthProvider;
use Microsoft\Graph\Core\Tasks\PageIterator;
use DateTimeInterface;
//NEW2
use Illuminate\Support\Facades\Session;

use Microsoft\Graph\Generated\Users\UsersRequestBuilderGetRequestConfiguration;
use Microsoft\Graph\Generated\Users\UsersRequestBuilderGetQueryParameters;

class MicrosoftGraphController extends Controller
{
    protected $graphService;

    
    public function __construct()
    {
        $clientId = env('MICROSOFT_GRAPH_CLIENT_ID');
        $clientSecret = env('MICROSOFT_GRAPH_CLIENT_SECRET');
        $tenantId = env('MICROSOFT_GRAPH_TENANT_ID');
        $clientCredentialProvider = new ClientCredentialContext($tenantId, $clientId, $clientSecret);

        $this->graphService = new GraphServiceClient($clientCredentialProvider);
    }

    public function showManager()
{
    if (!Session::isStarted()) {
        Session::start();
    }

    // Логируем все данные сессии для отладки
    Log::info('Session Data:', Session::all());

    // Получаем userId и userName из сессии
    $userId = Session::get('user.userId');
    $userName = Session::get('user.userName');

    // Логируем userId, чтобы убедиться, что он есть
    Log::info('User ID in session:', ['userId' => $userId]);

    // Проверяем, есть ли userId в сессии
    if (!$userId) {
        Log::error('User ID not found in session');
        return response()->json(['error' => 'User ID not found in session'], 404);
    }

    try {
        // 🔹 Получаем данные пользователя через Microsoft Graph API
        $user = $this->graphService->users()->byUserId($userId)->get()->wait();

        if (!$user) {
            Log::error('User not found in Azure AD', ['userId' => $userId]);
            return response()->json(['error' => 'User not found in Azure AD'], 404);
        }

        // 🔹 Получаем email пользователя
        $userMail = $user->getMail() ?: $user->getUserPrincipalName();

        // Логируем данные пользователя
        Log::info('Fetched user data:', [
            'userId' => $userId,
            'userName' => $userName,
            'userMail' => $userMail
        ]);

        return response()->json([
            'userName' => $userName,
            'userMail' => $userMail,
        ]);
    } catch (\Exception $e) {
        Log::error('Error fetching user from Microsoft Graph:', ['message' => $e->getMessage()]);
        return response()->json(['error' => 'Error fetching user', 'message' => $e->getMessage()], 500);
    }
}


    public function showReportees()
{
    if (!Session::isStarted()) {
        Session::start();
    }
    
    // Zugriff auf die Session-Daten direkt über die Session-Facade
    $userId = Session::get('user.userId');

    $result = $this->graphService->users()->byUserId($userId)->directReports()->get()->wait();
    
    $items = [];
    
    $pageIterator = new PageIterator($result, $this->graphService->getRequestAdapter());
    
    if ($result) {
        $pageIterator->setHeaders(['Content-Type' => 'application/json']);
        $pageIterator->iterate(function ($result) use (&$items) {
            // Сохранение DisplayName в массив
            $items[] = $result->getDisplayName();
            return true;
        });

        // Преобразование массива в JSON строку
        $itemsJson = json_encode($items);

        // Сохранение JSON строки в сессии
        Session::put('reportees', $itemsJson);

        // Возвращаем JSON вместо обычного массива
        return response()->json($items);
    } else {
        return response()->json(['error' => 'Reporter not found'], 404);
    }
}


public function getAllUsers()
{
    try {
        $userList = [];
        $nextLink = null;

        do {
            
            $queryParameters = new UsersRequestBuilderGetQueryParameters();
            $queryParameters->top = 999; 
            $queryParameters->select = ['id', 'displayName', 'mail', 'userPrincipalName'];

            
            $requestConfig = new UsersRequestBuilderGetRequestConfiguration();
            $requestConfig->queryParameters = $queryParameters;

            
            if ($nextLink) {
                \Log::info("Fetching next page: " . $nextLink);
                $usersResponse = $this->graphService->createRequest('GET', $nextLink)->execute();
            } else {
                \Log::info("Fetching first page");
                $usersResponse = $this->graphService->users()->get($requestConfig)->wait();
            }

            
            $users = $usersResponse->getValue();
            \Log::info("Fetched " . count($users) . " users from current page");

            
            if ($users) {
                foreach ($users as $user) {
                    $email = $user->getMail() ?: $user->getUserPrincipalName();

                    if (preg_match('/(2000|4000|6500|2500|onmicrosoft|MySWN)/', $email)) {
                        continue;
                    }

                    $userList[] = [
                        'id' => $user->getId(),
                        'displayName' => $user->getDisplayName(),
                        'email' => $email,
                    ];
                }
            }

            $nextLink = $usersResponse->getAdditionalData()['@odata.nextLink'] ?? null;
            \Log::info("Next link: " . ($nextLink ?? 'none'));

        } while ($nextLink); 

        Session::put('allUsers', $userList);

        return response()->json($userList);
    } catch (\Exception $e) {
        \Log::error('Error fetching users: ' . $e->getMessage());
        return response()->json(['error' => 'Error fetching users', 'message' => $e->getMessage()], 500);
    }
}




}