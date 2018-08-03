$(document).ready(function(){
    $("#exchangeTemplate .vh-2").css('height', (window.innerHeight-$(".notMain").innerHeight())/2);
        $("#exchangeTemplate .vh-3").css('height', (window.innerHeight-$(".notMain").innerHeight())/3);
    $("#exchangeTemplate .vh-1").css('height', window.innerHeight-$(".notMain").innerHeight());
  

    $("tbody").css('height', ($(".widgets").height()-$("h4").height()-$('thead').height()));


    $("tbody").css('width', $(this).closest("table").width());

    

    
});











$(document).ready(function() {
    $("#openedOrders").click(function () {
        //alert("Checked");
        if ($(this).is(':checked')) {
             
            $("#myOrders tbody tr").each(function () {
                if ($(this).find(".statusMyOrder").text() != 'Open'){
                    $(this).css('display', 'none');
                   // console.log('1');
                }
            })
        }
        else{
            $("#myOrders tr").each(function () {

                    $(this).css('display', 'table-row');
                    // console.log('1');

            })
        }

    })

    $("#myOrdersSearch").keyup(function(){
        searchString = $("#myOrdersSearch").val();
        if(searchString!='') {
            $("#myOrders tbody tr").each(function () {
                i=0;
                $("td", this).each(function () {
                    i++;
                    if($(this).text().toLowerCase().indexOf(searchString.toLowerCase())>-1){
                        return false;

                    }
                    if(i==7){
                        $(this).parent().css('display', 'none');
                    };
                });

            })
        }
        else {
            $("#myOrders tbody tr").each(function () {

                      $(this).css('display', 'table-row');

                   // $(this).css('background-color', 'green');
                    // console.log('1');

            })

        }
        })
    })





$(document).ready(function(){
    $("input").on('input', function(){
            priceBUY=$("#priceBuy").val();
    amountBUY=$("#amountBuy").val();
    totalBUY=$("#totalBuy");
        if(amountBUY!=0&&priceBUY!=0){
            d=priceBUY*amountBUY;
            totalBUY.val(d.toFixed(8));
}
            priceSell=$("#priceSell").val();
    amountSell=$("#amountSell").val();
    totalSell=$("#totalSell");
        if(amountSell!=0&&priceSell!=0){
            d=priceSell*amountSell;
            totalSell.val(d.toFixed(8));
        }
})
})

$(document).ready(function(){
    


setInterval(glassOrdersSell, 3000);
setInterval(glassOrdersBuy, 3000);
setInterval(getTradeHistory, 3000);
})







 function glassOrdersSell(){

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    dataString= ({
        'currencyFrom': $("#currencyFromId").val(),
        'currencyTo': $("#currencyToId").val(),

    });

  $.ajax({
    
    method:'GET',
    url: "/getGlassOrdersSell",
    //data: 'currencyFrom='+$("#currencyFromId").val()+'&currencyTo='+$("#currencyToId").val(),
    data: dataString,



    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    //
    success: function(data){
        $(".sell tbody").html(data);
        

  },
   error: function(data){
       // alert("fail");
    }

  })
}



 function glassOrdersBuy(){

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    dataString= ({
        'currencyFrom': $("#currencyFromId").val(),
        'currencyTo': $("#currencyToId").val(),

    });

  $.ajax({
    
    method:'GET',
    url: "/getGlassOrdersBuy",
    //data: 'currencyFrom='+$("#currencyFromId").val()+'&currencyTo='+$("#currencyToId").val(),
    data: dataString,



    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    //
    success: function(data){
        $(".buy tbody").html(data);
        

  },
   error: function(data){
       // alert("fail");
    }

  })
}



function getTradeHistory(){

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    dataString= ({
        'currencyFrom': $("#currencyFromId").val(),
        'currencyTo': $("#currencyToId").val(),

    });

  $.ajax({
    
    method:'GET',
    url: "/getTradeHistory",
    //data: 'currencyFrom='+$("#currencyFromId").val()+'&currencyTo='+$("#currencyToId").val(),
    data: dataString,



    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    //
    success: function(data){
        $(".trade_history tbody").html(data);
        

  },
   error: function(data){
       // alert("fail");
    }

  })
}