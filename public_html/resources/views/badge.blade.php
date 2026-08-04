<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Success</title>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&display=swap" rel="stylesheet"> --}}
</head>
<style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .badge-contain {
        margin: auto;
        width: 390px;
        max-width: 100%;
        padding: 20px;
        border: 1px solid #38a99a;
        /* background-size: cover;
            background-repeat: no-repeat;
            background-position: center; */
    }

    img {

        width: 100%
    }

    .badge-hd {

        background-color: #79C143;
        color: #fff
    }

    .badge-hd h2 {
        font-size: 20px;
        text-transform: uppercase;
        padding: 12px;
        text-align: center;
        margin-top: 0;
    }

    .container,
    .container-fluid,
    .container-lg,
    .container-md,
    .container-sm,
    .container-xl,
    .container-xxl {
        width: 100%;
        padding-right: var(--bs-gutter-x, .75rem);
        padding-left: var(--bs-gutter-x, .75rem);
        margin-right: auto;
        margin-left: auto;
    }

    .container {
        margin: 0 auto;
        padding: 0px 0px;
    }

    @media only screen and (min-width: 576px) {
        .container {
            max-width: 540px;
        }
    }

    @media only screen and (min-width: 768px) {
        .container {
            max-width: 720px;
        }
    }

    @media only screen and (min-width: 992px) {
        .container {
            max-width: 960px;
        }
    }

    @media only screen and (min-width: 1200px) {
        .container {
            max-width: 1140px;
        }
    }

    @media only screen and (min-width: 1320px) {
        .container {
            max-width: 1380px;
        }
    }


    @media screen and (max-width:660px) {

        .container,
        .container-fluid,
        .container-lg,
        .container-md,
        .container-sm,
        .container-xl {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .badge-contain {

            padding: 0
        }

    }

    .badge-img img {


        width: 220px;
        display: block;
        margin: auto;
        margin-bottom: 24px;
    }

    .badge-user-detail table {

        margin: auto
    }

    .badge-user-detail table th {

        text-align: left;
        padding-right: 50px;
        padding-bottom: 10px;
        font-weight: 400;
    }

    .badge-user-detail table td {

        padding-left: 15px;
        position: relative;
        padding-bottom: 10px;
        font-weight: 500;
    }

    .badge-user-detail table td::before {

        content: ":";
        display: block;
        position: absolute;
        top: 0;
        left: 0;
    }

    .badge-qr img {

        width: 120px;
        display: block;
        margin: 20px auto
    }

    .visitor-info h3 {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .visitor-info p {
        text-align: center;
        font-size: 13px;
        margin-top: 0;
    }

    .hiff-logo img {
        width: 160px;
        display: block;
        margin: auto;

        margin-top: 30px;
    }
</style>
<body>
   <div class="badge-contain">
        <div class="container">
            <div class="badge-hd">
                <h2>Visitors</h2>
            </div>
            <div class="badge-img" style="text-align: center;">
                <img src="data:image/png;base64, {{ $imageLogo23 }}" alt="">
            </div>
            <div class="badge-user-detail">
                <table>
                    <tr>
                        <th>Name</th>
                        <td>{{ $visitor['name'] }}</td>
                    </tr>
                    <tr>
                        <th>Profile</th>
                        <td>{{ $visitor['profile'] }}</td>
                    </tr>
                    <tr>
                        <th>
                            Designation
                        </th>
                        <td>{{ $visitor['designation'] }}</td>
                    </tr>
                    <tr>
                        <th>
                            Company
                        </th>
                        <td>{{ $visitor['company_name'] }}</td>
                    </tr>
                    <tr>
                        <th>
                            City
                        </th>
                        <td>{{ $visitor['city'] }}</td>
                    </tr>
                    <tr>
                        <th>
                            Badge ID
                        </th>
                        <td>ReExpo2026/{{ $badge_no }}</td>
                    </tr>
                </table>
            </div>
            <div class="badge-qr" style="text-align: center;">
                <img alt="" src="data:image/png;base64,{{ $qrCodeBase64 }} ">
            </div>
            <div class="visitor-info">
                <p style="width: max-content;">Note : Show the badge at the entrance of the exhibition</p>
            </div>
            <div class="hiff-logo" style="text-align: center;">
                <img src="data:image/png;base64, {{ $imageLogo }}" alt="">
            </div>
        </div>
    </div>
</body>

</html>
