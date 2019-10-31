function validate(){
    var username=document.register_form.username.value;
    if(username.length >=8){
        // document.getElementById("first_name").style.border="2px solid red";
        document.getElementById('err_username').innerHTML="enter your name";
        
        document.register_form.username.focus()
        return false;

    }else{
        document.getElementById('err_name').innerHTML=" ";

    }
    address =document.register_form.address.value;
    if(address ==''){
        document.getElementById('err_address').innerHTML="enter your address";
        document.register_form.address.focus()
        return false;

    }
}