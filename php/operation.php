<?php
require_once ("db.php");
require_once ("component.php");

$con = Createdb();

// Create button click
if(isset($_POST['create'])){
    createData();
}

// Updatedate
if(isset($_POST['update'])) {
    UpdateData();
    $bookid = textboxValue("book_id");
}

//Delete Data
if(isset($_POST['delete'])){
    deleteRecord();
}
if (isset($_POST['deleteall'])){
    deleteAll();
}


function createData() {
    $bookname = textboxValue("book_name");
    $bookpublisher = textboxValue("book_publisher");
    $bookprice = textboxValue("book_price");


    if($bookname && $bookpublisher && $bookprice){
        $sql = "INSERT INTO books(book_name, book_publisher, book_price) 
                VALUES('$bookname','$bookpublisher','$bookprice')";

        if (mysqli_query($GLOBALS['con'], $sql)) {
            TextNode("Success", "Record Successfully Inserted...!");
        }else {
            echo "Error";
        }
    } else {
        //echo "Provide Data in the Textbox";
        TextNode("error", "Provide Data in the Textbox");
    }
}


function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if (empty($textbox)){
        return false;

    }else {
        return $textbox;
    }
}

//messages
function TextNode($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}

// get data from mysql database
function getData() {
    $sql = "SELECT * FROM books";
    $result = mysqli_query($GLOBALS['con'], $sql);
    if (mysqli_num_rows($result) > 0){
/*        while ($row = mysqli_fetch_assoc($result)){
            echo "Id:" . $row["id"]."-Book Name:".$row['book_name'];
        }*/
        return $result;

    }
}

// Update data
function UpdateData(){
    $bookid = textboxValue("book_id");
    $bookname = textboxValue("book_name");
    $bookpublisher = textboxValue("book_publisher");
    $bookprice = textboxValue("book_price");

    if($bookname && $bookpublisher && $bookprice) {
        $sql = "
            UPDATE books SET book_name = '$bookname', book_publisher = '$bookpublisher', book_price='$bookprice' WHERE id='$bookid'
        ";
        if (mysqli_query($GLOBALS['con'], $sql)) {
            TEXTNode("success", "Data Successfully Updated");
        } else {
            TEXTNode("error", "Enable to Update Data");
        }
    }else {
        TEXTNode("error", "Select Data Using Edit Icon");
    }
}

// Detele Data
function deleteRecord (){
    $bookid = (int)textboxValue("book_id");
    $sql = " DELETE FROM books WHERE id=$bookid";
    if (mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success", "Record Deleted Successfully...!");
    }else {
        TextNode ("error", "Enable to Delete Record");
    }
}

function deleteBtn(){
    $result = getData();
    $i = 0;
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 3){
                buttonElement("btn-deleteall", "btn btn-danger", "<i class='fas fa-trash'></i> Delete All", "deleteall", "");
                return;
            }
        }
    }
}

function deleteAll(){
    $sql = "DROP TABLE books";
    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success", "All Record Deleted Successfully...!");
        Createdb();
    }else {
        TextNode("error", "Something Went Wrong Record Cannot Deleted...!");
    }
}

// set id to textbox
function setID(){
    $getid = getData();
    $id = 0;
    if($getid){
        while($row = mysqli_fetch_assoc($getid)){
            $id = $row['id'];
        }
    }
    return ($id + 1);

}