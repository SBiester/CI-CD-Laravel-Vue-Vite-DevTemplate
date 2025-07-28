<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Idea Bewertung Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/filepond/dist/filepond.css">
    <link rel="stylesheet" href="http://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css">
    <style>
       body, html{
        margin: 0;
        padding: 0;
        height: 100%;
        overflow: hidden;

       }

        .page-header {
            /* background-image: url('../assets/img/curved-images/curved0.jpg')  ; */
            /* Background image for header */
            background-position: center;
            background-size: cover;
            height: 200px;
            position: relative;
            border-radius: 15px;

        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.097);
            /* White background with some opacity */
            padding: 20px;

            display: flex;

            justify-content: flex-start;
            /* Reduced padding */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            /* width: 500px  ; Fixed width */

            /* Center the form */
            bottom: 100px;
            font-family: 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 12px;
            color: darkslateblue;

            text-align: left;


        }
        /* .container {

            height: 100vh;
            background-color: rgba(255, 255, 255, 0.113);
            border-radius: 15px;
            display: flex;
            box-shadow: 0 4px 30px rgba(255, 255, 255, 0.1);

            border: 1px solid rgba(255, 255, 255, 0.3);
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(to bottom, #ffffff 50%, #f4f4f4 50%);



        } */
        /* .background{
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;

        } */

        .description {
            font-size: 11px;
            margin-bottom: 1px;
        }

        .col-md-6 button {
            background-color: gray;
            border-color: white;
            font-size: 10px;

        }
        .form-label{
            margin-top: 10px;
        }


        .form-canvas {
            display: flex;
            border-radius: 10px;
        }


        .drop-zone {

            height: 100px;
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-family: "Quicksand", sans-serif;
            font-weight: 500;
            font-size: 20px;
            cursor: pointer;
            color: #cccccc;
            border: 0.01em dashed #b6b6b6;
            border-radius: 10px;

        }

        .drop-zone--over {
            border-style: solid;
        }

        .drop-zone__input {
            display: none;
        }

        .drop-zone__thumb {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
            background-color: #cccccc;
            background-size: cover;
            position: relative;
        }

        .drop-zone__thumb::after {
            content: attr(data-label);
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 5px 0;
            color: #ffffff;
            background: rgba(0, 0, 0, 0.75);
            font-size: 14px;
            text-align: center;
        }

        .filepond--drop-label{
            background-color: #ffffff;

            border-radius: 10px;
            border: 1px solid rgba(128, 128, 128, 0.16);
        }

        nav {
            position: absolute;
            top: 20px;
            left: 50%;
            margin-left: 150px;
            margin-right: 150px;
            justify-content: space-around;
            background-color: rgba(255, 255, 255, 0.071);
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1;
            border-radius: 15px;
            height: 40px;

            }
            nav ul {
                list-style: none;
                display: flex;
                gap: 20px;
                margin: 0;
                padding: 0;
                font-size: 12px;
            }
            nav li {
                display: flex;
            }
            nav a {
                text-decoration: none;
                color: #007bff;
                font-weight: bold;
                transition: color 0.3s ease;

            }
            nav a:hover{
                color: #0056b3;
            }
            .page-container{

                height: 100vh;
                display: flex;
                align-items: center;
                background-size:contain;
                background-repeat: no-repeat;
                background-position: left;
                background-image: url('../assets/img/illustrations/idea2.png') ;
                justify-content: flex-end;
                padding-right: 20px;


            }

            .card{
                background-color: rgba(240, 231, 231, 0.072);

                border-radius: 15px;
                box-shadow: 0 4px 6px rgba(222, 220, 220, 0.104);
                margin-top: 100px;
                display: flex;
                width:100%;


                position: relative;
                min-width: 300px;
                overflow-y: auto;
                overflow-x: auto;



            }
            .container-fluidx{
                position: absolute;
                z-index: 1;

                padding-right: 20px;
                padding-left: 20px;


                margin-top: 150px;

                text-align: center ;
                width: 56%;
                height: 100%;



            }
    </style>
</head>

<body>
    <div class="page-container">
        <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 my-3 blur blur-rounded shadow-blur py-2 start-0 end-0 mx4">
            <div class="container-fluid container-fluid">

            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse ps" id="navigation">
                <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                    <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="http://127.0.0.1:8000/dashboard">
                        <i class="fa fa-chart-pie opacity-6 me-1 text-dark"></i>
                        Dashboard
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link me-2" href="http://127.0.0.1:8000/profile">
                        <i class="fa fa-user opacity-6 me-1 text-dark"></i>
                        Profile
                    </a>
                    </li>
                        <li class="nav-item">
                    <a class="nav-link me-2" href="http://127.0.0.1:8000/static-sign-up">
                    <i class="fas fa-user-circle opacity-6 me-1 text-dark"></i>
                    Sign Up
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="http://127.0.0.1:8000/static-sign-in">
                    <i class="fas fa-key opacity-6 me-1 text-dark"></i>
                    Sign In
                    </a>
                </li>
                </ul>

            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
            </div>
        </nav>


    {{-- <div class="container"> --}}
        <div class="container-fluidx blur  ">
            {{-- <div class="page-header min-height-200 border-radius-xl ">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div> --}}
            {{-- <div class="card card-body blur  shadow-blur mx-4 mt-n6 form-container">

                <h1 class="text-center mb-4 text-uppercase"> Ideenmanagment </h1>
            </div> --}}
            <div class="card card-body blur blur-rounded shadow border-0 mx-4 mt-n6 form-container">
                <form method="POST" action="/upload" enctype="multipart/form-data" >
                    @csrf
                    <div>

                        <h5 class="h5 text-center"> *******IDEAMANAGMENT*******</h5>
                        <hr class="horizontal darak mt-0">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="vorgangsnuummer" class="form-label">Vorgangsnummer</label>
                                <input type="text" name="vorgangsnuummer" id="vorgangsnuummer" class="form-control" >
                            </div>
                            <div class="col-md-6">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Enter Title" required>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="einreicher" class="form-label">Einreicher*innen </label>
                                <input type="text" name="einreicher" id="einreicher" class="form-control"
                                    placeholder="Nach Person(en) suchen" required>
                            </div>
                            <div class="col-md-6">
                                <label for="anmerkungen" class="form-label">Anmerkungen</label>
                                <input name="anmerkungen" id="anmerkungen" class="form-control" required></input>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="pronlembeschreibung" class="form-label">Promlembeschreibung</label>
                                <textarea name="pronlembeschreibung" id="pronlembeschreibung" class="form-control" rows="1,5" ></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="losungsbeschreibung" class="form-label">Lösungsbeschreibung</label>
                                <textarea name="losungsbeschreibung" id="losungsbeschreibung" class="form-control" rows="2"  ></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">

                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" id="date" class="form-control"  >
                            </div>
                            <div class="col-md-6">
                                <label for="file" class="form-label">Attachment</label>
                                {{-- <input type="file" id="filepond" name="file"> --}}
                                <div class="drop-zone">
                                    <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                    <input type="file" name="attachment" id="file" class="drop-zone__input">
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-center  ">
                        <button type="submit" class="btn btn-primary">Submit Idea</button>
                    </div>


                </form>
            </div>
        </div>
</div>





            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="{{ mix('/js/app.js') }}"></script>
            <script src="{{ asset('js/script.js') }}"></script>

            {{-- <script src="http://unpkg.com/filepond/dist/filepond.min.js"></script>

            <script src="http://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>
            <script src="http://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>


            <script>
                FilePond.registerPlugin(
                    FilePondPluginFileValidateType,
                    FilePondPluginImagePreview
                );
                const inputElement = document.querySelector('input[id="file"]');
                const pond = FilePond.create(inputElement, {
                    acceptedFileType: ['image/*' , 'application/pdf'],
                    allowMultiple:false,
                    server: {
                        process: '/upload',
                        revert: '/revert',
                    }
                });
            </script> --}}
</body>

</html>
