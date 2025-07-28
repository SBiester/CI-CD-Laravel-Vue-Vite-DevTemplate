

$(document).on('click','.approve-btn', function() {
    console.log("approve btn clickd");
    let ideaId = $(this).data('id');
    //Approve button click event
    $.ajax({
        url: '/ideas/approve' + ideaId,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')

        },
        success: function(response) {
                alert('Status approved success');
                location.reload();
        },
        error: function(err){
                console.error(err);
                alert('Error updating status');
        }
        });
    });
    $(document).on('click','.reject-btn', function() {
        let ideaId = $(this).data('id');
        //Reject button click event
        $.ajax({
            url: '/ideas/reject' + ideaId,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')

            },
            success: function(response) {
                    alert('Status rejected success');
                    location.reload();
            },
            error: function(err){
                    console.error(err);
                    alert('Error updating status');
            }
            });
        });
//         error: function() {
//             alert('An error occurred!')
//         }
//     });

//     $('.approve-btn').click(function() {
//         let ideaID = $(this).data('id');
//         updateIdeaStatus(ideaId, 'approved')
//     });
//     //Reject button click event
//     $('.reject-btn').click(function() {
//         let ideaID = $(this).data('id');
//         updateIdeaStatus(ideaId, 'rejected')
//     });

//     // Function to send ajax request
//     function updateIdeaStatus(id, status) {

//     }
// });
