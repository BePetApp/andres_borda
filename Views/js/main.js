$(document).ready( function () {
  $('#dataTable').dataTable({
    serverSide: true,
    ajax:  {
      url: 'index.php?page=usersJson',
      type: 'POST'
    },
    columns: [
      {data: "1"},
      {data: "2"},
      {data: "3"},
      {"render":
        function ( data, type, row ) {
          return ('<a class="py-1 px-2 bg-yellow-500 rounded hover:bg-yellow-800" href="index.php?page=crudEdit&Id=' + row[0] + '">Edit</a>');
        }, 
        orderable: false,
        searchable: false},
      {"render":
        function ( data, type, row ) {
          return ('<a class="py-1 px-2 bg-red-500 rounded hover:bg-red-800" href="index.php?page=crudDel&Id=' + row[0] + '">Delete</a>');
        },
      orderable: false,
      searchable: false}
    ]
  }
)});
