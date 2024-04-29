<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.10/pdfmake.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap5.min.css"> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <link href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap5.min.js"></script>
        {{-- <script src="/vendor/datatables/buttons.server-side.js"></script> --}}
  </head>
  <body>
    @if (session('success'))
        <div id="successMessage" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div style="text-align: right; margin-right:10%">
        <a href="{{url('/')}}/register"><button class="btn btn-info">Add New</button></a>
        <a href="{{url('/')}}/logout"><button class="btn btn-danger">Logout</button></a>

    </div>
    <div style="margin-left:1%" class="container">
        <button id="exportBtn" class="btn btn-primary">Export to CSV</button>
        <button id="excelBtn" class="btn btn-primary">Export to Excel</button>

        {{$dataTable->table()}}

    </div>
    

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
  </body>
  <script>

let dataTable = <?php echo json_encode($dataTable); ?>;
    

    console.log(dataTable);

    // function confirmStatusChange(event) {
    //     let confirmation = confirm("Are you sure you want to change the status?");

    //     if (!confirmation) {
    //         event.preventDefault();
    //         return false;
    //     }
    // }

    document.addEventListener('DOMContentLoaded', function() {

        var successMessage = document.getElementById('successMessage');

        if (successMessage) {
            setTimeout(function() {
                successMessage.remove();
            }, 3000); 
        }
    }); 
    
    document.getElementById("exportBtn").addEventListener("click", function() {
      var table = document.getElementById("athletes-table");
      var csv = [];

      for (var i = 0; i < table.rows.length; i++) {
        var row = [];
        for (var j = 0; j < table.rows[i].cells.length; j++) {
          row.push(table.rows[i].cells[j].innerText);
        }
        csv.push(row.join(","));
      }

      var csvContent = csv.join("\n");

      var blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });

      var link = document.createElement("a");
      if (link.download !== undefined) { 
        var url = URL.createObjectURL(blob);
        link.setAttribute("href", url);
        link.setAttribute("download", "data.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      } else {
        alert("Your browser does not support automatic download. Please right-click the button and select 'Save link as...' to download the CSV file.");
      }
    });


    document.getElementById('excelBtn').addEventListener('click', function () {
            var table = document.getElementById('athletes-table');

            var wb = XLSX.utils.table_to_book(table);

            var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

            var blob = new Blob([s2ab(wbout)], { type: 'application/octet-stream' });

            saveAs(blob, 'table_export.xlsx');
        });

        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
            return buf;
        }


        function updateTableData(event) {
            // console.log(event.target.dataset.id);
            let confirmation = confirm("Are you sure you want to change the status?");
            
            if (!confirmation) {
                event.preventDefault();
                return false;
            }
            let id = event.target.dataset.id
            
            
            $.ajax({
                url: `http://localhost/forms/public/athletes/status/${id}`, // Replace with your actual route URL
                method: 'GET',
                success: function(data) {
                    let element = document.querySelector(`[data-id="${id}"]`);
                    if(element.classList.contains('btn-danger')){
                        element.classList.remove('btn-danger');
                        element.classList.add('btn-success');
                        element.innerText = 'Active'
                    } 
                    else{
                        element.classList.remove('btn-success');
                        element.classList.add('btn-danger');
                        element.innerText = 'Inactive'
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error if needed
                }
            });
        }
  </script>
</html>