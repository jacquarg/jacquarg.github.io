
// Check if the form is submitted 
if ( isset( $_POST['submit'] ) ) { 

    // retrieve the form data by using the element's name attributes value as key 
    $firstname = $_POST['firstname']; 
    $lastname = $_POST['lastname']; 
    // display the results
    echo '<h3>Form POST Method</h3>'; echo 'Your name is ' . $lastname . ' ' . $firstname; 

    exit; 
} 




function isValidPhoneNumber($str) {
    $cleaned = preg_replace("/[^+0-9]/", '', $str);
    # adaoted from : https://www.oreilly.com/library/view/regular-expressions-cookbook/9781449327453/ch04s03.html
    return preg_match("/^\+?(?:[0-9]?){6,14}[0-9]$/", $cleaned);
}


// validate number format.
// send email : orodatage, num, ...
