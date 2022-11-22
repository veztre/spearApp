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
        font-size: 25px;
        font-family: verdana;
        text-align: left;
        margin-top: 0px;
        float: left;
        margin: 0px;
        line-height: 50px;
        padding-left: 9px;
    }

    .top-left {
        position: absolute;
        top: 8px;
        left: 16px;
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
            <div class="logo">
                <img src="{{url('/storage/'.$logo)}}" alt="" width="100px" height="100px">
            </div>
            <div style="margin-left:115px;">
                <p style="font-size:25px;">{{$org_name}}</p>
                <p style="font-size:15px;">Department: {{$department}}</p>
            </div>
        </div>
        <hr />
        <h5 style="text-align:center; font-size:15px;"><b>REQUEST LETTER </b></h5>
        <p>{{date_format($date,"F d Y")}}</p>
        <br>
        <br>
        <i> Dear Sir/Madam </i>
        <br>
        <br>
        The {{$org_name}} would like to request the use of the venue {{$venue}}
        for the purpose of {{$purpose}}
        <br>
        from {{date_format(new DateTime($startDate),"F d Y g:i:s A")}} to {{date_format(new DateTime($endDate),"F d Y g:i:s A")}}
        <br> <br>
        We, Promise that the event will be held based on youe the existing process of the University
        <br> <br>
        Hoping for the favorable Response on the Matter
        <br> <br>
        <table>
            <tr>
                <td style="padding-right:150px"> Respectfully Yours </td>
                <td style="padding-left:150px"> Noted By </td>
            </tr>
            <tr>
                <td style="padding-right:150px">
                    @if($sign_owner!='')
                    <img src="{{url('/storage/'.$sign_owner)}}" height=50 width="100" alt="">
                    @endif
                </td>
                <td style="padding-left:150px">
                    @if($sign_stud_body!='')
                    <img src="{{url('/storage/'.$sign_stud_body)}}" height=50 width="100" alt="">
                    @endif
                </td>
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
                <td style="padding-right:150px"> Recommended By </td>
                <td style="padding-left:150px"> Recommended By</td>
            </tr>
            <tr>
                <td style="padding-right:150px">
                    @if($sign_adviser!='')
                    <img src="{{url('/storage/'.$sign_adviser)}}" height=50 width="100" alt="">
                    @endif
                </td>
                <td style="padding-left:150px">
                    @if($sign_chairperson!='')
                    <img src="{{url('/storage/'.$sign_chairperson)}}" height=50 width="100" alt="">
                    @endif
                </td>
            </tr>
            <tr>
                <td style="padding-right:150px">{{$adviser_firstname}} {{$adviser_lastname}}</td>
                <td style="padding-left:150px">{{$chairperson_firstname}} {{$chairperson_lastname}}</td>
            </tr>
            <tr>
                <td style="padding-right:150px">{{$adviser_role}}</td>
                <td style="padding-left:150px">{{$chairperson_role}}</td>


            </tr>


            <tr>
                <td style="padding:10px" colspan='2'> &nbsp;</td>
            </tr>

            <tr>
                <td style=" padding-right:150px"> Recomended By</td>
            </tr>
            <tr>
                <td style="padding-right:150px">
                    @if($dean_sign!='')
                    <img src="{{url('/storage/'.$dean_sign)}}" height=50 width="100" alt="">
                    @endif
                </td>
            </tr>
            <tr>
                <td style="padding-right:150px">{{$dean_firstname}} {{$dean_lastname}}</td>
            </tr>
            <tr>
                <td style="padding-right:150px">{{$dean_role}}</td>
            </tr>
            <tr>
                <td style="padding:15px" colspan='2'> &nbsp;</td>
            </tr>
            <tr>
                <td style="padding-right:150px">Approved By</td>
            </tr>
            <tr>
                <td style="padding-right:150px">
                    @if ($chancellor_sign!='')
                    <img src="{{url('/storage/'.$chancellor_sign)}}" height=50 width="100" alt="">
                    @endif
                </td>
            </tr>
            <tr>
                <td style="padding-right:150px">{{$chancellor_firstname}} {{$chancellor_lastname}}</td>
            </tr>
            <tr>
                <td style="padding-right:150px">{{$chancellor_role}}</td>
            </tr>
        </table>

    </div>

</body>

</html>
