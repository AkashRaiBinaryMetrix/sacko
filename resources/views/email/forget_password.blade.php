<html>
<head>
    <style>
        body{
            background-color: rgb(241, 241, 239);
        }
    *{
        margin: 0;
        padding: 0;
    }
    .heading {
            background-color: lightgray;
            text-transform: capitalize;
            padding: 10px;
        }
    table tr th{
        float:left;
        text-transform: capitalize;
    }
    table tr td{
        padding-left:15px;
        text-transform: capitalize;
    }
    .email_2{
        color:blue;
        font-weight: 600;
    }
       
    </style>
</head>
<body>
    <div class="container">
        <div class="heading">
            <h1>Saloo App</h1>
        </div>
        <table id="customers">
            <tr>
                <th>Full Name</th>
                <td><?php echo $var_employee_id; ?> </td>
            </tr>
            
            <tr>
                <th>Message</th>
                <td>{{ 'Actually I forgot my Password please reset my password and provide the new password' }}</td>
            </tr>
        </table>
    </div>
</body>

</html>