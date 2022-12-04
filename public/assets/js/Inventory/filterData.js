$(document).ready(function() {
    $('#schBarcode').on('focusout', function() {
        var frmSchBarcode = document.getElementById('frmSchBarcode');
        frmSchBarcode.submit();
        /* var barcode = $(this).val();
        if(barcode) {
            $.ajax({
                url: 'Inventory-search/1/'+barcode,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log("Hi from Ajax");
                    $('#tableSearch').empty();
                    $.each(data, function(key, value) {
                        
                        if (value["HdwType"] == 101) {
                            var t = `<tr>
                            <td>`+value['HdwBarcode']+`</td>
                            <td>`+value["device"]+`</td>
                            <td>`+value["company"]+`</td>
                            <td>`+value["stock"]+`</td>
                            <td>`+value["hdType"]+` من `+ value["stockName"]+`</td>
                            <td><button class="btn btn-success data-toggle="modal"
                            data-hdwbarcode=`+value['HdwBarcode']+
                            `data-deviceid=`+value['TohdwId']+
                            `data-devicename=`+value['device']+
                            `data-companyid=`+value['ManfId']+
                            `data-companyname=`+value['company']+
                            `data-modeledit=`+value['HdwModel']+
                            `data-typeid=`+value['HdwType']+
                            `data-typename=`+value['hdType']+
                            `data-stockid=`+value['StockIN']+
                            `data-stockname=`+value['stock']+
                            `data-target="#edit-device"><i class="fas fa-edit"></i></button></td>
                            </tr>`;
                            $('#tableSearch').append(t);
                        } else {
                            $('#tableSearch').append('<tr><td>'+value["HdwBarcode"]+'</td><td>'+value["device"]+'</td><td>'+value["company"]+'</td><td>'+value["stock"]+'</td><td>'+value["hdType"]+'</td></tr>');    
                        }
                        
                    });
                } 
            });    
        }else{
            $('#tableSearch').empty();
        } */
    });
    $('#schStoreId').on('focusout', function() {
        var frmSchStoreId = document.getElementById('frmSchStoreId');
        frmSchStoreId.submit();
        /* var storeId = $(this).val();
        if(storeId) {
            $.ajax({
                url: 'Inventory-search/2/'+storeId,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log("Hi from Ajax");
                    $('#tableSearch').empty();
                    $.each(data, function(key, value) {
                        $('#tableSearch').append('<tr><td>'+value["HdwBarcode"]+'</td><td>'+value["device"]+'</td><td>'+value["company"]+'</td><td>'+value["stock"]+'</td><td>'+value["hdType"]+'</td></tr>');
                    });
                } 
            });    
        }else{
            $('#tableSearch').empty();
        } */
    });
    /* $('select[name="schStockId"]').on('change', function() { */
    $('#schStockId').on('focusout', function() {
        var frmSchStockName = document.getElementById('frmSchStockName');
        frmSchStockName.submit();
        
    });
    
    $('select[name="schHardwareId"]').on('change', function() {
        var frmSchHardwareId = document.getElementById('frmSchHardwareId');
        frmSchHardwareId.submit();
        /* var hardwareId = $(this).val();
        if(hardwareId) {
            $.ajax({
                url: 'Inventory-search/4/'+hardwareId,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log("Hi from Ajax");
                    $('#tableSearch').empty();
                    $.each(data, function(key, value) {
                        $('#tableSearch').append('<tr><td>'+value["HdwBarcode"]+'</td><td>'+value["device"]+'</td><td>'+value["company"]+'</td><td>'+value["stock"]+'</td><td>'+value["hdType"]+'</td></tr>');
                    });
                } 
            });    
        }else{
            $('#tableSearch').empty();
        } */
    });
    $('select[name="schManufacturerId"]').on('change', function() {
        
        var frmSchManufacturerId = document.getElementById('frmSchManufacturerId');
        frmSchManufacturerId.submit();
        /* var manufacturerId = $(this).val();
        if(manufacturerId) {
            $.ajax({
                url: 'Inventory-search/5/'+manufacturerId,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log("Hi from Ajax");
                    $('#tableSearch').empty();
                    $.each(data, function(key, value) {
                        $('#tableSearch').append('<tr><td>'+value["HdwBarcode"]+'</td><td>'+value["device"]+'</td><td>'+value["company"]+'</td><td>'+value["stock"]+'</td><td>'+value["hdType"]+'</td></tr>');
                    });
                } 
            });    
        }else{
            $('#tableSearch').empty();
        } */
    });

    $('select[name="schInvtyType"]').on('change', function() {
        
        var frmSchInvtyType = document.getElementById('frmSchInvtyType');
        frmSchInvtyType.submit();
        /* var invtyType = $(this).val();
        if(invtyType) {
            $.ajax({
                url: 'Inventory-search/6/'+invtyType,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log("Hi from Ajax");
                    $('#tableSearch').empty();
                    $.each(data, function(key, value) {
                        $('#tableSearch').append('<tr><td>'+value["HdwBarcode"]+'</td><td>'+value["device"]+'</td><td>'+value["company"]+'</td><td>'+value["stock"]+'</td><td>'+value["hdType"]+'</td></tr>');
                    });
                } 
            });    
        }else{
            $('#tableSearch').empty();
        } */
    });

    $('#printEmp').on('focusout', function() {
        var frmPrintEmp = document.getElementById('frmPrintEmp');
        frmPrintEmp.submit();
         
        /* $.ajax({
            url: 'Inventory-newsearch/200',
            type: "GET",
            dataType: "json",
            success:function(data) {
                console.log("Hi from Ajax Button");
                $('#tableSearch').empty();
                $.each(data, function(key, value) {
                    $('#tableSearch').append('<tr><td>'+value["HdwBarcode"]+'</td><td>'+value["device"]+'</td><td>'+value["company"]+'</td><td>'+value["stock"]+'</td><td>'+value["hdType"]+'</td></tr>');
                });
            } 
        }); */
    });
    $('#btnReset').on('click', function() {
        
        /* $.ajax({
            url: 'Inventory-newsearch/200',
            type: "GET",
            dataType: "json",
            success:function(data) {
                console.log("Hi from Ajax Button");
                $('#tableSearch').empty();
                $.each(data, function(key, value) {
                    $('#tableSearch').append('<tr><td>'+value["HdwBarcode"]+'</td><td>'+value["device"]+'</td><td>'+value["company"]+'</td><td>'+value["stock"]+'</td><td>'+value["hdType"]+'</td></tr>');
                });
            } 
        }); */
    });
    
    
    
});