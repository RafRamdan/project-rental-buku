<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
<body>

<h1>Data Table Rentlog</h1>

<table id="customers">
  <tr>
    <th>No.</th>
    <th>User</th>
    <th>Book</th>
    <th>Rent Date</th>
    <th>Return Date</th>
    <th>Actual Return Date</th>
  </tr>
  @foreach ($data as $item)
    <tr class="{{ $item->actual_return_date == null ? '' : ($item->return_date < $item->actual_return_date ? 'text-bg-danger' : 'text-bg-success') }}">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->user->username }}</td>
        <td>{{ $item->book->title }}</td>
        <td>{{ $item->rent_date }}</td>
        <td>{{ $item->return_date }}</td>
        <td>{{ $item->actual_return_date }}</td>
    </tr>
  @endforeach 
  
</table>

</body>
</html>


