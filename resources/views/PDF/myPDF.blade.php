<html>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img src="" alt="" width="120px" height="120px">
            </div>
            <div class="col-8 padding-left:5px">
                <h3>{{$org_name}}</h3>
                <h4>Department: {{$department}}</h4>

            </div>
        </div>
        <hr />
        <div class="row">
            <h5 style="text-align:center;"><b>REQUEST LETTER </b></h5>
            <p>{{date_format($date,"F d Y")}}</p>
            <br>
            <br>
            <i> Dear Sir/Madam </i>
            <br>
            <br>
            The {{$org_name}} would like to request the use of the venue
            for the Purpose of {{$purpose}}
            <br>
            from {{date_format(new DateTime($startDate),"F d Y g:i:s A")}} to {{date_format(new DateTime($endDate),"F d Y g:i:s A")}}
            <br> <br>
            We, Promise that the event will be held based on youe the existing process of the University
            <br> <br>
            Hoping for the favorable Response on the Matter
            <br> <br>
        </div>
        <table>
            <tr>
                <td style="padding-right:150px"> Respectfully Yours </td>
                <td style="padding-left:150px"> Noted By </td>
            </tr>
            <tr>
                <td style="padding-right:150px"><img src="{{url('/storage/'.$sign_owner)}}" height=50 width="100" alt=""></td>
                <td style="padding-left:150px"><img src="{{url('/storage/'.$sign_stud_body)}}" height=50 width="100" alt=""></td>
            </tr>
            <tr>
                <td style="padding-right:150px">{{$owner_firstname}} {{$owner_lastname}}</td>
                <td style="padding-left:150px">{{$stud_body_firstname}} {{$stud_body_lastname}}</td>
            </tr>
            <tr>
                <td style="padding-right:150px">{{$role}}</td>
                <td style="padding-left:150px">{{$stud_body_role}}</td>


            </tr>
            <tr>
                <td style="padding:10px" colspan='2'> &nbsp;</td>
            </tr>

            <tr>
                <td style=" padding-right:150px"> Recomended By</td>
                <td style="padding-left:150px"> Recomended By </td>
            </tr>
            <tr>
                <td style="padding-right:150px"><img src="{{url('/storage/'.$sign_owner)}}" height=50 width="100" alt=""></td>
                <td style="padding-left:150px"><img src="{{url('/storage/'.$sign_stud_body)}}" height=50 width="100" alt=""></td>

            </tr>
            <tr>
                <td style="padding-right:150px">{{$owner_firstname}} {{$owner_lastname}}</td>
                <td style="padding-left:150px"> {{$stud_body_firstname}} {{$stud_body_lastname}}</td>

            </tr>
            <tr>
                <td style="padding-right:150px">{{$role}}</td>
                <td style="padding-left:150px">{{$stud_body_role}}</td>


            </tr>
            <tr>
                <td style="padding:15px" colspan='2'> &nbsp;</td>
            </tr>
            <tr>
                <td style="padding-right:150px"><img src="{{url('/storage/'.$sign_owner)}}" height=50 width="100" alt=""></td>
            </tr>
            <tr>
                <td style="padding-right:150px">{{$role}}</td>
            </tr>
            <tr>
                <td style="padding-right:150px">{{$role}}</td>
            </tr>
        </table>

    </div>

</body>

</html>
