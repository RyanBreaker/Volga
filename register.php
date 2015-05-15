<?php
include "header.php";
?>

    <main>
        <form id="register">
            <div>Items marked with an asterisk (*)<br>are required.</div>
            <table>
                <!--Username & Password-->
                <tr>
                    <th class="thead first" colspan="2">Account ID & Pass</th>
                </tr>
                <tr title="Email will be used as your login's username.">
                    <th><label for="email">Email:</label></th>
                    <td><input type="text" id="email"> *</td>
                </tr>
                <tr title="Re-enter your email.">
                    <th><label for="emailconf">Confirm Email:</label></th>
                    <td><input type="text" id="emailconf"> *</td>
                </tr>
                <tr title="Create a password, 6-12 characters.">
                    <th><label for="pass">Password:</label></th>
                    <td><input type="password" id="pass"> *</td>
                </tr>
                <tr title="Confirm password.">
                    <th><label for="passconf">Confirm Password:</label></th>
                    <td><input type="password" id="passconf"> *</td>
                </tr>

                <!--User Information-->
                <tr>
                    <th class="thead" colspan="2">User Information</th>
                </tr>
                <tr title="Your first name.">
                    <th><label for="firstname">First name:</label></th>
                    <td><input type="text" id="firstname"> *</td>
                </tr>
                <tr title="Your last name.">
                    <th><label for="lastname">Last name:</label></th>
                    <td><input type="text" id="lastname"> *</td>
                </tr>
                <tr title="Your address">
                    <th><label for="address">Address:</label></th>
                    <td><input type="text" id="address"> *</td>
                </tr>
                <tr title="Use only if applicable.">
                    <th><label for="address2">Address 2:</label></th>
                    <td><input type="text" id="address2" class="notrequired"></td>
                </tr>
                <tr title="Enter your city.">
                    <th><label for="city">City:</label></th>
                    <td><input type="text" id="city"> *</td>
                </tr>
                <tr>
                    <th><label for="state">State:</label></th>
                    <td><select id="state">
                            <option>Alaska</option>
                            <option>Iowa</option>
                            <option>Wisconsin</option>
                        </select> *
                    </td>
                </tr>
                <tr title="Enter your ZIP code.">
                    <th><label for="zip">Zip:</label></th>
                    <td><input type="text" id="zip"> *</td>
                </tr>

                <!--Billing-->
                <tr>
                    <th class="thead" colspan="2">Billing Information</th>
                </tr>
                <tr>
                    <th><label for="cardtype">Card Type:</label></th>
                    <td>
                        <select id="cardtype">
                            <option>Visa</option>
                            <option>MasterCard</option>
                            <option>Discover</option>
                            <option>AMEX</option>
                        </select> *
                    </td>
                </tr>
                <tr title="Enter your credit card number.">
                    <th><label for="cardnumber">Card Number:</label></th>
                    <td><input type="text" id="cardnumber"> *</td>
                </tr>
                <tr title="Enter your credit cardholder's name.">
                    <th><label for="cardholdername">Cardholder Name:</label></th>
                    <td><input type="text" id="cardholdername"> *</td>
                </tr>
                <tr>
                    <th><label for="cardexpiration">Expiration:</label></th>
                    <td>
                        <select id="cardexpiration">
                            <option>01 - January</option>
                            <option>02 - February</option>
                            <option>03 - March</option>
                            <option>04 - April</option>
                            <option>05 - May</option>
                            <option>06 - June</option>
                            <option>07 - July</option>
                            <option>08 - August</option>
                            <option>09 - September</option>
                            <option>10 - October</option>
                            <option>11 - November</option>
                            <option>12 - December</option>
                        </select>
                        <label for="cardexpirationyear"></label>
                        <select id="cardexpirationyear">
                            <option>2015</option>
                            <option>2016</option>
                            <option>2017</option>
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                        </select> *
                    </td>
                </tr>
            </table>
            <button type="submit">Register</button>
            <button type="reset">Reset</button>
        </form>
    </main>

<?php include "footer.php";
