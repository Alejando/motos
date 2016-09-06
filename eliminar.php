<html>
    <head>
         <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    </head>
    <body>
        <table id="tabla" >
            <tr>
                <td>
                    <button class="delete" data-id-transferencia="1"></button>
                </td>                
            <tr/>
            <tr>
                <td>
                    <button class="delete" data-id-transferencia="1"></button>
                </td>                
            <tr/>
            <tr>
                <td>
                    <button class="delete" data-id-transferencia="1"></button>
                </td>                
            <tr/>
            <tr>
                <td>
                    <button class="delete" data-id-transferencia="1"></button>
                </td>                
            <tr/>
            <tr>
                <td>
                    <button class="delete" data-id-transferencia="1"></button>
                </td>                
            <tr/>
            <tr>
                <td>
                    <button class="delete" data-id-transferencia="1"></button>
                </td>                
            <tr/>
            <tr>
                <td>
                    <button class="delete" data-id-transferencia="1"></button>
                </td>                
            <tr/>
        </table>
        <script>
            $('#tabla').on('click', '.delete', function(e){
                console.log(e.target);
                var id=this.dataset.idTransferencia;
                //slplice para elminar
                $(this).closest('tr').remove();
//                alert("adios!!");
                
            });
        </script>
    </body>
</html>