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
    </head>
<body>
    <h1>List Of Members</h1>
    <table id="customers">
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Sex</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
        @foreach ($members as $member)
            <tr>
                <td>{{$member->fname}}</td>
                <td>{{$member->lname}}</td>
                <td>{{$member->sex}}</td>
                <td>{{$member->phone}}</td>
                <td>{{$member->address}}</td>
            </tr>
        @endforeach
    </table>

    <h1>List Of Exhibitor</h1>
    <table id="customers">
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
        @foreach ($exhibitors as $exh)
            <tr>
                <td>{{$exh->name}}</td>
                <td>{{$exh->phone}}</td>
                <td>{{$exh->address}}</td>
            </tr>
        @endforeach
    </table>

    <h1>List Of Products</h1>
    <table id="customers">
        <tr>
            <th>Exhibitor</th>
            <th>Product</th>
            <th>Description</th>
        </tr>
        @foreach ($products as $item)
            <tr>
                <td>{{get_exhibitor_id($item->exhibition_id)->name}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->description}}</td>
            </tr>
        @endforeach
    </table>

    <h4><strong>Total Subscription:</strong> 0</h4>
    <h4><strong>Total Payments:</strong> 0</h4>
    <h4><strong>Registration Fee:</strong> 5ZWL</h4>

    <h1>Voting Results</h1>
    <table id="customers">
        <tr>
            <th>#</th>
            <th>Exhibitor</th>
            <th>Votes</th>
        </tr>
        @php
            $count = 0;
        @endphp
        @foreach ($votes as $vote)
            @php
                $exhibitor = get_exhibition($vote->exhibition_id);
                $count++;
                //echo $count;
            @endphp
            <tr>
                <td>{{$count}}</td>
                <td>{{$exhibitor->name}}</td>
                <td>{{$vote->total}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>


