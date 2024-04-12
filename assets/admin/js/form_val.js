$(document).ready(function(){

    $('#logoutmodel').on('click', function(){
        $('#exampleyyhhy').modal('show');
    });
    $('.closeModel').on('click', function(){
        $('#exampleyyhhy').modal('hide');
    });
    $(document).on('click', '.deleteRow', function() {
        var dataHref = $(this).data('delete-href');
        //alert(dataHref);
        $('#deleteModal').find('a#delete').attr('href', dataHref);
        $('#deleteModal').modal('show');
    });
    $('.closeModel').on('click', function(){
        $('#deleteModal').modal('hide');
    });
    $(document).on('click', '.editRow', function() {
        var id = $(this).attr("data-id");
        $('#hidden_id').val(id);
        $('#editModal').modal('show');
        $.ajax({
            type: "GET",
            url : base_url+'edit/'+id,
			dataType: 'json',
            success: function (data) {
                $('#edit-task').val(data[0].task_add);
			}
        
        });
    });
    $('#Edittodo').validate({  
    
        rules: {
            task_add: { required: true},
        },
            highlight: function(element) {
            $(element).removeClass("error");
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url : base_url+'edit-tesk',
                dataType : 'json',
                data: $(form).serialize(),
    
                success: function (data) { 
                    $("#Edittodo #submit").prop("disabled", false);
    
                    if(data.flag == 1)
                    {     
                        // $('#Addtodo')[0].reset();
                        // var retHtml = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>'+data.msg+'.</div>';
                        // $('#Addtodo .alert-message').removeClass('error').addClass('success').html(retHtml);
                        // window.setTimeout(function() {
                        //     location.reload();
                        // }, 3000);
                        location.reload();
                    }
                    else 
                    {     
                        var retHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error!</strong>'+data.msg+'.</div>';
                        $('#Edittodo .alert-message').removeClass('success').addClass('error').html(retHtml);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error("Error: " + errorThrown);
                },
            
            });
        }
    });
    $('.closeModel').on('click', function(){
        $('#editModal').modal('hide');
    });
    $('#register').validate({  

        rules: {
            name: { required: true },
            email: { required: true,email: true},
            phone: { required: true, minlength: 10, maxlength: 10,},
            password: {required: true,minlength: 5},
            confirm_password: {required: true,minlength: 5,equalTo: "#password"}
        },
        messages: {
             
            name: { required: "Please enter Name."},
            email: { required: "Please enter Email.",email:"Please enter valid Email."},
            phone: { required: "Please enter Phone no."},
            password: { required: "Please Enter Password"},
        },
            highlight: function(element) {
            $(element).removeClass("error");
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url : base_url+'register_form',
                dataType : 'json',
                data: $(form).serialize(),
                // headers: {
                // 'X-CSRF-Token': $('#csrftoken').val(),
                // },
                // beforeSend: function() 
                // {
                //     $("#register #submit").prop("disabled", true);
                // },
    
                success: function (data) { 
                    $("#register #submit").prop("disabled", false);
    
                    if(data.flag == 1)
                    {     
                            $('#register')[0].reset();
                            var retHtml = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>'+data.msg+'.</div>';
                            $('#register .alert-message').removeClass('error').addClass('success').html(retHtml);
                            
                            window.setTimeout(function() {
                                window.location.href = data.req;
                            }, 3000);
                    }
                    else 
                    {    
                        // $('#csrftoken').val(data.csrf_token);  
                        var retHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error!</strong>'+data.msg+'.</div>';
                        $('#register .alert-message').removeClass('success').addClass('error').html(retHtml);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error("Error: " + errorThrown);
                },
            
            });
        }
    });
    
    $('#login').validate({  
    
        rules: {
            email_phone: { required: true},
            password: {required: true,minlength: 5},
        },
            highlight: function(element) {
            $(element).removeClass("error");
        },
        submitHandler: function(form) {
            $.ajax({
                type: "POST",
                url : base_url+'login_form',
                data: $(form).serialize(),
                dataType: "json",
    
                success: function (data) { 
                    $("#login #submit").prop("disabled", false); 
                    if(data.flag == 1)
                    {     
                        $('#login')[0].reset();
                        var retHtml = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>'+data.msg+'.</div>';
                        $('#login .alert-message').removeClass('error').addClass('success').html(retHtml);
                        
                        window.setTimeout(function() {
                            window.location.href = data.req;
                        }, 2000);
                    }
                    else 
                    {      
                        var retHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error!</strong>'+data.msg+'.</div>';
                        $('#login .alert-message').removeClass('success').addClass('error').html(retHtml);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error("Error: " + errorThrown);
                },
            });
        }
    });
    
    $('#Addtodo').validate({  
    
        rules: {
            task_add: { required: true},
        },
            highlight: function(element) {
            $(element).removeClass("error");
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url : base_url+'add-tesk',
                dataType : 'json',
                data: $(form).serialize(),
    
                success: function (data) { 
                    $("#Addtodo #submit").prop("disabled", false);
    
                    if(data.flag == 1)
                    {     
                        // $('#Addtodo')[0].reset();
                        // var retHtml = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>'+data.msg+'.</div>';
                        // $('#Addtodo .alert-message').removeClass('error').addClass('success').html(retHtml);
                        // window.setTimeout(function() {
                        //     location.reload();
                        // }, 3000);
                        location.reload();
                    }
                    else 
                    {     
                        var retHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error!</strong>'+data.msg+'.</div>';
                        $('#Addtodo .alert-message').removeClass('success').addClass('error').html(retHtml);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error("Error: " + errorThrown);
                },
            
            });
        }
    });

    
    $(document).on('click', '.change-status', function() {
    
        var id = $(this).attr("data-id");
        var status_value = $(this).attr("data-value");
        //const csrfkey = $('.txt_csrfname').attr('name');
        var dataArr = {
            //[csrfkey] : $('.txt_csrfname').attr('value'),
            id: id,
            status_value : status_value
        };
    
        $.ajax({
            type: "POST",    
            url: base_url+"status",
            data: dataArr,
            dataType : "json",
            async: false,
            beforeSend: function() {;
            },
            success: function(data)
            {
                console.log(data);
                if(data.status == 1){
                location.reload();
                }
                else{
                //$('.txt_csrfname').val(data.csrf_token)
                }
            }
        });
    
    });
});


