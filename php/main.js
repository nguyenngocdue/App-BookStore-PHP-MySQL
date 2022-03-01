// $(".btnedit").click(e=>{
//     console.log("clicked");
// })

let id = $("input[name*='book_id']");
id.attr("readonly", "readonly");

$(".btnedit").click(e =>{
    let textvalues = displayData(e);
    // console.log(textvalues);

    //Select input cells
    let bookname = $("input[name*='book_name']");
    let bookpublisher = $("input[name*='book_publisher']");
    let bookprice = $("input[name*='book_price']");

    // Set value into inpit cell
    id.val(textvalues[0]);
    bookname.val(textvalues[1]);
    bookpublisher.val(textvalues[2]);
    bookprice.val(textvalues[3].replace("$",""));

});
function displayData(e) {
    let id = 0;
    const td = $("#tbody tr td");
    let textvalues = [];
    for (const value of td){
        if (value.dataset.id == e.target.dataset.id)
        {
/*            console.log(e.target);
            console.log(value);*/
        textvalues[id++] =value.textContent;
        }
    }
    return textvalues;
}



