// Hier können JavaScript Functionen und Klassen definiert werden


 function pushJS(ID, pages) {

   for (var i = 0; i < pages.length; i++) {

     $(pageID + i).click(function () {
       $.post("core/navigation.php"),
       {
         pagename: "ID"

       },
       function(data, status){
         alert("Data: " + data + "\nStatus: " + status);
       }
     })
   }



}
