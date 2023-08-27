function inputErrors(error){
    $.each(error, function(inputName, message){
        $(`input[name='${inputName}']`).siblings('.text-error').text(message.toString());
    })
}
