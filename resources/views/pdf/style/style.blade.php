<style type="text/css">
    body {
        font-family: "DejaVu Sans";
    }
    html {
        margin: 0px;
        padding: 0px;
    }
    table {
        border-collapse: collapse;
    }
    .header-left {
        padding-top: 45px;
        padding-top: 65px;
        padding-bottom: 45px;
        padding-left: 30px;
        display:inline-block;
        width:30%;
    }
    @page {
        margin-top: 60px !important;
    }
    .header-table {
        background: #010d6f;
        position: absolute;
        width: 100%;
        height: 141px;
        left: 0px;
        top: -60px;
    }
    .header-logo {
        position: absolute;
        height: auto;
        text-transform: capitalize;
        color: #fff;
    }
    .header-right {
        display:inline-block;
        width:35%;
        float:right;
        padding: 20px 30px 20px 0px;
        padding: 60px 30px 20px 0px;
        text-align: right;
        color:white;
    }
    .inv-flex{
        display:flex;
    }
    .inv-data{
        text-align:right;
        margin-right:120px;
    }
    .inv-value{
        text-align:left;
        margin-left:160px;
    }
    .header {
        font-size: 20px;
        color: rgba(0, 0, 0, 0.7);
    }
    .TextColor1 {
        font-size: 16px;
        color: rgba(0, 0, 0, 0.5);
    }
    .wrapper {
       display: block;
       margin-top: 100px;
       padding: 0px 30px 20px 30px;
    }
    .address {
        display: block;
        padding-top: 20px;
    }
    .client {
        padding: 0 0 0 30px;
        display: inline;
        float:left;
        width:100%;
    }
    .client h1 {
        font-style: normal;
        font-weight: bold;
        font-size: 15px;
        line-height: 22px;
        letter-spacing: 0.05em;
        margin-bottom: 0;
    }
    .heading-details {
        font-style: normal;
        font-weight: bold;
        font-size: 15px;
        line-height: 22px;
        letter-spacing: 0.05em;
        margin-bottom: 0;
    }
    p {
        font-size: 15px;
    }
    .company-add {
        font-style: normal;
        font-weight: normal;
        font-size: 10px;
        line-height: 15px;
        color: #595959;
        margin-top: 0px;
    }
    /* -------------------------- */
    /* billing style */
    .bill-address-container {
        display: block;
        /* position: absolute; */
        float:right;
        padding: 0 40px 0 0;
    }
    .bill-to {
        font-style: normal;
        font-weight: normal;
        font-size: 12px;
        line-height: 18px;
        padding: 0px;
        margin-bottom: 0px;
    }
    .bill-user-name {
        max-width: 250px
        font-style: normal;
        font-weight: normal;
        font-size: 15px;
        line-height: 22px;
        padding: 0px;
        margin-top: 0px;
        margin-bottom: 0px;
    }
    .bill-user-address {
        font-style: normal;
        font-weight: normal;
        font-size: 10px;
        line-height: 15px;
        color: #595959;
        padding: 0px;
        margin: 0px;
        width: 170px;
    }
    .bill-user-phone {
        font-style: normal;
        font-weight: normal;
        font-size: 10px;
        line-height: 15px;
        color: #595959;
        padding: 0px;
        margin: 0px;
    }
    /* -------------------------- */
    /* shipping style */
    .ship-address-container {
        display: block;
        float:right;
        padding: 0 30px 0 0;
    }
    .ship-to {
        font-style: normal;
        font-weight: normal;
        font-size: 12px;
        line-height: 18px;
        padding: 0px;
        margin-bottom: 0px;
    }
    .ship-user-name {
        max-width: 250px
        font-style: normal;
        font-weight: normal;
        font-size: 15px;
        line-height: 22px;
        padding: 0px;
        margin-top: 0px;
        margin-bottom: 0px;
    }
    .ship-user-address {
        font-style: normal;
        font-weight: normal;
        font-size: 10px;
        line-height: 15px;
        color: #595959;
        padding: 0px;
        margin: 0px;
        width: 170px;
    }
    .ship-user-phone {
        font-style: normal;
        font-weight: normal;
        font-size: 10px;
        line-height: 15px;
        color: #595959;
        padding: 0px;
        margin: 0px;
    }
    .job-add {
        display: inline;
        float: right;
        width:40%;
    }
    .amount-due {
        background-color: #f2f2f2;
    }
    .textRight {
        text-align: right;
    }
    .textLeft {
        text-align: left;
    }
    .textStyle1 {
        font-size: 12;
        font-weight: bold;
        line-height:22px;
        color: rgba(0, 0, 0, 0.8);
    }
    .textStyle2 {
        font-size: 12;
        line-height:22px;
        color: rgba(0, 0, 0, 0.7);
    }
    .main-table-header td {
        padding: 5px;
        padding-bottom: 10px;
    }
    .main-table-header {
        border-bottom: 1px solid red;
    }
    .table2 {
        margin-top: 30px;
        padding: 0px 30px 10px 30px;
        page-break-before: avoid;
        page-break-after: auto;
    }
    hr {
        margin: 0 30px 0 30px;
        color:rgba(0, 0, 0, 0.2);
        border: 0.5px solid #EAF1FB;
    }
    .table2 hr {
        height:0.1px;
    }
    .ItemTableHeader {
        font-size: 13.5;
        text-align: center;
        color: rgba(0, 0, 0, 0.85);
        padding: 5px;
    }
    tr.main-table-header th {
        border-bottom: 0.620315px solid #E8E8E8;
        font-style: normal;
        font-weight: normal;
        font-size: 12px;
        line-height: 18px;
    }
    tr.item-details td {
        font-style: normal;
        font-weight: normal;
        font-size: 12px;
        line-height: 18px;
    }
    .items {
        font-size: 13;
        color: rgba(0, 0, 0, 0.6);
        text-align: center;
        padding: 5px;
        padding-top: 10px;
    }
    .note-header {
        font-size: 13;
        color: rgba(0, 0, 0, 0.6);
    }
    .note-text {
        font-size: 10;
        color: rgba(0, 0, 0, 0.6);
    }
    .padd8 {
        padding-top: 8px;
        padding-bottom: 8px;
    }
    .padd2 {
        padding-top: 2px;
        padding-bottom: 2px;
    }
    .table3 {
        border: 1px solid #EAF1FB;
        /* border-top: none; */
        box-sizing: border-box;
        margin-left: 500px;
        width: 764px;
        page-break-inside: avoid;
        page-break-before: auto;
        page-break-after: auto;
    }
    .text-per-item-table3 {
        border: 1px solid #EAF1FB;
        border-top: none;
        padding-right: 30px;
        box-sizing: border-box;
        width: 260px;
        /* height: 100px; */
        position: absolute;
        right: -25;
    }
    .inv-item {
        border-color: #d9d9d9;
    }
    .no-border {
        border: none;
    }
    .desc {
        font-weight: 100;
        text-align: justify;
        font-size: 10px;
        margin-bottom: 15px;
        margin-top:7px;
        color:rgba(0, 0, 0, 0.85);
    }
    .company-details{
        color: #fff;
        text-align: center;
        width: 40%;
    }
    .company-details h1 {
        margin:0;
        font-weight: 500;
        font-size: 24px;
        line-height: 36px;
        text-align: right;
    }
    .company-details h4 {
        margin:0;
        font-style: normal;
        font-weight: normal;
        font-size: 10px;
        line-height: 15px;
        text-align: right;
    }
    .company-details h3 {
         margin-bottom:1px;
         margin-top:0;
    }
    .notes {
        font-style: normal;
        font-weight: 300;
        font-size: 12px;
        color: #595959;
        margin-top: 15px;
        margin-left: 30px;
        width: 442px;
        text-align: left;
        page-break-inside: avoid;
    }
    .notes-label {
        font-style: normal;
        font-weight: normal;
        font-size: 15px;
        line-height: 22px;
        letter-spacing: 0.05em;
        color: #040405;
        width: 108px;
        height: 19.87px;
        padding-bottom: 10px;
    }

    ul li {
        font-size: 15px;
        letter-spacing: 0.05em;
    }
</style>
