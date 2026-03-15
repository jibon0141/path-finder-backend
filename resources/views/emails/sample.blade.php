<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f8; padding:20px;">

<table width="600" align="center" cellpadding="0" cellspacing="0"
       style="background:#ffffff; padding:20px; border:1px solid #ddd;">

    <!-- Header -->
    <tr>
        <td>
            <h2 style="margin:0; color:#333;">INVOICE</h2>
            <p style="margin:5px 0; color:#777;">Invoice #INV-001</p>
            <p style="margin:5px 0; color:#777;">Date: 01 Jan 2026</p>
        </td>
        <td align="right">
            <h3 style="margin:0;">Demo Company</h3>
            <p style="margin:5px 0;">Dhaka, Bangladesh</p>
            <p style="margin:5px 0;">support@demo.com</p>
        </td>
    </tr>

    <tr><td colspan="2"><hr></td></tr>

    <!-- Billing -->
    <tr>
        <td colspan="2">
            <h4 style="margin-bottom:5px;">Bill To:</h4>
            <p style="margin:0;">Abid Hasan</p>
            <p style="margin:0;">abid@email.com</p>
            <p style="margin:0;">Dhaka</p>
        </td>
    </tr>

    <tr><td colspan="2"><br></td></tr>

    <!-- Items -->
    <tr>
        <td colspan="2">
            <table width="100%" cellpadding="8" cellspacing="0"
                   style="border-collapse: collapse;">
                <tr style="background:#f0f0f0;">
                    <th align="left" style="border:1px solid #ddd;">Item</th>
                    <th align="center" style="border:1px solid #ddd;">Qty</th>
                    <th align="right" style="border:1px solid #ddd;">Price</th>
                    <th align="right" style="border:1px solid #ddd;">Total</th>
                </tr>

                <tr>
                    <td style="border:1px solid #ddd;">Web Development</td>
                    <td align="center" style="border:1px solid #ddd;">1</td>
                    <td align="right" style="border:1px solid #ddd;">৳10,000</td>
                    <td align="right" style="border:1px solid #ddd;">৳10,000</td>
                </tr>

                <tr>
                    <td style="border:1px solid #ddd;">Hosting</td>
                    <td align="center" style="border:1px solid #ddd;">1</td>
                    <td align="right" style="border:1px solid #ddd;">৳2,000</td>
                    <td align="right" style="border:1px solid #ddd;">৳2,000</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr><td colspan="2"><br></td></tr>

    <!-- Total -->
    <tr>
        <td></td>
        <td>
            <table width="100%">
                <tr>
                    <td>Subtotal:</td>
                    <td align="right">৳12,000</td>
                </tr>
                <tr>
                    <td>VAT (5%):</td>
                    <td align="right">৳600</td>
                </tr>
                <tr>
                    <td><strong>Grand Total:</strong></td>
                    <td align="right"><strong>৳12,600</strong></td>
                </tr>
            </table>
        </td>
    </tr>

    <tr><td colspan="2"><hr></td></tr>

    <!-- Footer -->
    <tr>
        <td colspan="2" align="center">
            <p style="font-size:12px; color:#777;">
                Thank you for your business!
            </p>
        </td>
    </tr>

</table>

</body>
</html>
