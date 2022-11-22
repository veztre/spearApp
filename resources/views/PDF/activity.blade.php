<html>
<style type="text/css">
    .header {
        width: 100%;
        height: 100px;

    }

    body {
        margin-left: 50px;
        padding: 0px;
    }

    .logo {
        color: #663399;
        font-family: verdana;
        text-align: left;
        margin-top: 0px;
        float: left;
        margin: 0px;
        line-height: 50px;
        padding-left: 9px;
    }

    .top-left {

        top: 40px;
        left: 50px;

    }



    @media print {
        @page {
            margin-top: 0;
            margin-bottom: 0;
        }

        body {
            padding-top: 50px;
            padding-bottom: 72px;
        }

        a[href]:after {
            content: none !important;
        }
    }
</style>


<body>
    <div class="container">
        <div class="header">

            @if (!isset($organization))
            <div class="logo">
                <img src="{{url('/images/BSU.png')}}" alt="" width="100px" height="100px" />
            </div>
            @else
            <div class="logo">
                <img src="{{url('/storage/'.$organization->logo)}}" alt="" width="100px" height="100px" />
            </div>
            <div class="top-left">
                <h2>{{$organization->name}} </h2>
            </div>

            @endif

        </div>

    </div>
    <hr />

    <h5 style="text-align:center; font-size:15px;"><b>ACTIVITY REPORT </b></h5>
    <h5 style="text-align:center; font-size:15px;"><b>{{$status}} </b></h5>


    <table style='border: 1px; '>
        <thead>
            <tr>
                <th> Venue</th>
                <th> Purpose</th>
                <th> Start Date</th>
                <th> End Date</th>
                <th> Status</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($activities as $activity)
            <tr>
                <td style="padding-right:15px">{{$activity['venue']}}</td>
                <td style="padding-right:15px">{{$activity['purpose']}}</td>
                <td style="padding-right:15px">{{$activity['startDate']}}</td>
                <td style="padding-right:15px">{{$activity['endDate']}}</td>
                <td style="padding-right:15px">{{$activity['status']}}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
    </div>
</body>

</html>
