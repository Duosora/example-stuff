$(document).ready(function () {
    console.log();
/*** 
const arr = location.pathname == '/guest/create'?["guest_submit1","guest_submit2","guest_submit3"]:["guest_submit4"]
    //hide Guest Submit By Default 
    arr.forEach(
        id => {
            const element = document.getElementById(id);
            element.style.visibility = 'hidden';
        }
    );
*/
    // Clicking the save button on the open modal for both CREATE and UPDATE
    $("a.flag").click(function (e) {

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        e.preventDefault();



        const type = "POST";
        const rec = event.target.id;
        const [ id, flag ] = rec.split("_");
        const toSend = {
            "id": id,
            "flag": flag,
            "_token": $('meta[name="csrf-token"]').attr('content')
        };

        const link = '/flag';

        $.ajax({
            type: type,
            url: link,
            data: toSend,
            dataType: 'json',
            success: function (data) {
                $("#flag_info").html(`<div class='alert alert-success'>Post has Been Successfully Flagged as ${toSend.flag}</div>`);
                console.log(`Flag Successful:${data} as ${toSend.flag}`);
            },
            error: function (data) {
                $("#flag_info").html("<div class='alert alert-danger'>Something Bad happened, Try Again</div>");
                console.log(`Error: ${JSON.stringify(data)}`)
            }
        });

    });

    
    // LIKE A POST
    $("a.like").click(function (e) {

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        e.preventDefault();


        const type = "POST";
        const id = window.location.pathname.split('-').splice(-1)[0];
        const toSend = {
            "id": id,
            "_token": $('meta[name="csrf-token"]').attr('content')
        };

        const link = '/like';

        $.ajax({
            type: type,
            url: link,
            data: toSend,
            dataType: 'json',
            success: function (data) {
                $("#like_info").html(`<div class='alert alert-success alert-dismissable'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Post has Been Liked ${toSend.flag}</div>`);
                console.log(`Post Successfully Liked:${data} as ${toSend.flag}`);
            },
            error: function (data) {
                $("#like_info").html(`<div class='alert alert-danger alert-dismissable'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> ${data.responseText}</div>`);
                console.log(`Error: ${JSON.stringify(data)}`)
            }
        });

    });



    
    // DISLIKE A POST
    $("a.dislike").click(function (e) {

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        e.preventDefault();


        const type = "POST";
        const id = window.location.pathname.split('-').splice(-1)[0];
        const toSend = {
            "id": id,
            "_token": $('meta[name="csrf-token"]').attr('content')
        };

        const link = '/dislike';

        $.ajax({
            type: type,
            url: link,
            data: toSend,
            dataType: 'json',
            success: function (data) {
                $("#like_info").html(`<div class='alert alert-success alert-dismissable'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Post has Been disliked ${toSend.flag}</div>`);
                console.log(`Post Successfully disLiked:${data} as ${toSend.flag}`);
            },
            error: function (data) {
                $("#like_info").html(`<div class='alert alert-danger alert-dismissable'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> ${data.responseText}</div>`);
                console.log(`Error: ${JSON.stringify(data)}`)
            }
        });

    });



        // Clicking the Delete All Post Button
        $("a.feature").click(function (e) {

            e.preventDefault();

            const type = "POST";
            const rec = event.target.id;
            const [ post_id, feature_type ] = rec.split("_");
            const toSend = {
                post_id,
                type: feature_type,
                "_token": $('meta[name="csrf-token"]').attr('content')
            };

            let msg;
            if (feature_type == 'U'){msg = "Are you sure you want to unfeature this post";}
            if (feature_type == 'F'){msg = "Are you sure you want to feature this post";}

            if (confirm(msg)) {

                $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

            const link = '/featurepost';

            $.ajax({
                type: type,
                url: link,
                data: toSend,
                dataType: 'json',
                success: function (data) {
                        $("#feature_info").html(`<div class='alert alert-success alert-dismissable'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>${data.message}</div>`);

                    if (feature_type == 'U'){
                         $(".feature").html(`Feature Post`);
                          document.getElementsByClassName('feature')[0].id = `${post_id}_F`;
                        }
                    else {
                        $(".feature").html(`UnFeature Post`);
                     document.getElementsByClassName('feature')[0].id = `${post_id}_U`;
                    }

                       console.log(`${data.message}`);
                },
                error: function (data) {
                    $("#feature_info").html(`<div class='alert alert-danger'>${data.message}</div>`);
                    console.log(`Error: ${JSON.stringify(data)}`)
                }
            });
        } else {
            $("#feature_info").html(`<div class='alert alert-success'>${data.message}</div>`);
        }

        });
});



    // Function for Liking a Comment
    function commentLike(id) {
        
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        const type = "POST";
        const toSend = {
            id,
            "_token": $('meta[name="csrf-token"]').attr('content')
        };

        const link = '/commentlike';

        $.ajax({
            type: type,
            url: link,
            data: toSend,
            dataType: 'json',
            success: function (data) {
                $(`#comment_info_${id}`).html(`<div class='alert alert-success alert-dismissable'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Post has Been Liked ${toSend.flag}</div>`);
                console.log(`Post Successfully Liked:${data} as ${toSend.flag}`);
            },
            error: function (data) {
                $(`#comment_info_${id}`).html(`<div class='alert alert-danger alert-dismissable'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> ${data.responseText}</div>`);
                console.log(`Error: ${JSON.stringify(data)}`)
            }
        });
    }


    
    // Function for Disliking a Comment
    function commentDislike(id) {
        
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        const type = "POST";
        const toSend = {
            id,
            "_token": $('meta[name="csrf-token"]').attr('content')
        };

        const link = '/commentdislike';

        $.ajax({
            type: type,
            url: link,
            data: toSend,
            dataType: 'json',
            success: function (data) {
                $(`#comment_info_${id}`).html(`<div class='alert alert-success alert-dismissable'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Post has Been Liked ${toSend.flag}</div>`);
                console.log(`Post Successfully Liked:${data} as ${toSend.flag}`);
            },
            error: function (data) {
                $(`#comment_info_${id}`).html(`<div class='alert alert-danger alert-dismissable'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> ${data.responseText}</div>`);
                console.log(`Error: ${JSON.stringify(data)}`)
            }
        });
    }







    // Clicking the Ban IP button to ban a user
    function banip(e,id) {

        e.preventDefault();

        if (confirm(`Are you sure you want to ban this user's IP`)) {

            $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        e.preventDefault();

        const type = "POST";
        const toSend = {
            id,
            "_token": $('meta[name="csrf-token"]').attr('content')
        };

        const link = '/banip';

        $.ajax({
            type: type,
            url: link,
            data: toSend,
            dataType: 'json',
            success: function (data) {
                if (data.message === 'already banned'){
                    $(`#${id}`).html(`${data.message}`);

                    alert(`IP Already Banned`);
                }
                else {
                    $(`#${id}`).html(`${data.message}`);
                    alert(`${data.message}`);
                }

                console.log(`${data.message}`);
            },
            error: function (data) {
                alert(`Something Bad happened,Reload this page and Try Again`);
                console.log(`Error: ${JSON.stringify(data)}`)
            }
        });
    } else {
        $("#altadmin_info").html("<div class='alert alert-success'>You almost banned this User's IP</div>");
    }

}


function handleGuest(id) {
    const changeIt = document.getElementById(id);
    changeIt.style.visibility = changeIt.style.visibility == 'hidden'?'visible':'hidden';
  }



function deleteall (e,id) {

    if (confirm("Are you sure you want to delete all of this user's posts")) {

        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    e.preventDefault();

    const [ post_id, feature_type ] = id.split("_");

    console.log(post_id, feature_type);

    const type = "POST";
    const toSend = {
        "id": post_id,
        "_token": $('meta[name="csrf-token"]').attr('content')
    };

    const link = '/deleteallposts';

    $.ajax({
        type: type,
        url: link,
        data: toSend,
        dataType: 'json',
        success: function (data) {
                $(`#${id}`).html(`${data.message}`);

                alert(`${data.message}`);

                console.log(`${data.message}` );
        },
        error: function (data) {

            $(`#${id}`).html("Something Bad happened, Try Again");

            alert(`${data.message}`);
            
            console.log(`Error: ${JSON.stringify(data)}`)
        }
    });
} else {
    alert('You almost deleted all of this User\'s Post');
}

}
