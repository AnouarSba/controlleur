<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Sakkal Majalla', sans-serif;
            font-size: 18px;
            line-height: 1.4;
            direction: rtl;
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            margin-top: 20px;
            border-bottom: 2px solid black;
        }

        .header2 {
            text-align: center;
            margin-bottom: 16px;
            line-height: 1;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
        }

        .section-title {
            margin-top: 30px;
            font-weight: bold;
            text-decoration: underline;
        }

        .info-line {
            margin-bottom: 10px;
        }

        .footer {
            margin-top: 60px;
            text-align: left;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <div class="header2">
        <p>الجمهورية الجزائرية الديمقراطية الشعبية</p>
        <p>وزارة النقل</p>
        <p>مديرية النقل لولاية سيدي بلعباس</p>
        <p> المؤسسة العمومية للنقل الحضري وشبه الحضري سيدي بلعباس </p>
    </div>
    <div class="info-line" style="margin-right: 450px;">
        سيدي بلعباس يوم: {{$att->date}}
    </div>
    <div class="info-line">
         {{$user->firstname}} {{$user->lastname}} 
    </div>
    <div class="info-line" >
        @if ($user->is_ == 7)
            قابض
        @elseif ($user->is_ == 8)
            سائق حافلة
        @endif
    </div>
    <div class="header" style="margin-top: 40px;">
        <h1>إلى السيدة</h1>
        <h1>رئيسة مصلحة الإدارة والمستخدمين</h1>
    </div>
    <div class="header">
        <h1>الموضوع:طلب شهادة عمل</h1>
    </div>


    <div class="info-line" style="margin-top: 130px;">
        لي عضيم الشرف أن أتقدم إلى سيادتكم بطلبي هذا المذكور أعلاه والمتمثل في طلب شهادة عمل.
    </div>
    <div class="info-line">
        وفي الأخير تقبلوا مني فائق التقدير والإحترام.
    </div>
    <div class="info-line">
        ملاحظة:
    <div class="info-line">
        هذا الطلب ثم على مستوى المنصة الرقمية للمؤسسة مرقم بـ {{ $att->id }}.
    </div>

</body>

</html>
