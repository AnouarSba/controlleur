<!--<style>
    HTML CSSResult Skip Results Iframe
/*
   general styles
*/
.center-block-horiz {
   margin-left: auto !important;
   margin-right: auto !important;
 }
.set-margin-cicis-menu-to-go {
  margin: 20px;
}
.set-padding-cicis-menu-to-go {
  padding: 20px;
}
.set-border-cicis-menu-to-go {
   border: 5px inset #4f4f4f;
}
set-box-shadow-cicis-menu-to-go {
  -webkit-box-shadow: 4px 4px 14px #4f4f4f;
     -moz-box-shadow: 4px 4px 14px #4f4f4f;
          box-shadow: 4px 4px 14px #4f4f4f;
}
  
/*
** Style the iframe
** =========================
*/
/*
    css commmon to all iframes
*/
.responsive-wrapper {
  position: relative;
  height: 0;    /* gets height from padding-bottom */
  overflow: hidden;
  /* put following styles (necessary for overflow and
     scrolling handling) inline in .embed-responsive-element-wrapper around iframe because not stable in CSS
    -webkit-overflow-scrolling: touch;
                      overflow: auto; */
}
.responsive-wrapper img,
.responsive-wrapper object,
.responsive-wrapper iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
   
  border-style: none;
  padding: 0;
  margin: 0;
}

/*
    css particular to this iframe
*/

#Iframe-Cicis-Menu-To-Go {
  max-width: 666.67px;
  max-height: 600px;
  overflow: hidden;
}
/*
   padding-bottom = h/w as %
*/
.responsive-wrapper-padding-bottom-90pct {
  padding-bottom: 90%;
}

</style>
<div id="Iframe-Cicis-Menu-To-Go" class="set-margin-cicis-menu-to-go set-padding-cicis-menu-to-go set-border-cicis-menu-to-go set-box-shadow-cicis-menu-to-go center-block-horiz">
  <div class="responsive-wrapper 
     responsive-wrapper-padding-bottom-90pct"
     style="-webkit-overflow-scrolling: touch; overflow: auto;">
     <iframe src="https://drive.google.com/file/d/1z6VcMpVL0pg_9XCNG6RGXNZ4D-4IVwBk/view?usp=share_link">
      <p style="font-size: 110%;"><em><strong>ERROR: </strong>
An &#105;frame should be displayed here but your browser version does not support &#105;frames.</em> Please update your browser to its most recent version and try again, or access the file <a href="https://drive.google.com/file/d/0BxrMaW3xINrsR3h2cWx0OUlwRms/preview"with this link.</a></p>
    </iframe>
  </div>
</div> -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<section id="" class="main" style="top:50px; height:auto">

    <br>
    @if (Illuminate\Support\Facades\Auth::user()->service != null)

        <div class="row col-12 justify-content-center" style="font-family: Aparajita;font-size: 25px;direction:rtl;">

            <center>
                <h1 class="" style="color: #3d80e4">
                    التعليمات</h1>
            </center>
            <div class="" style="text-align: center;font-family: Aparajita;font-size: 25px">
                <p> </p>
            </div>
            <br>


            @if (Illuminate\Support\Facades\Auth::user()->service == 99 || Illuminate\Support\Facades\Auth::user()->service == 1)
                 <div id="accordion" class=" col-12 shadow p-3 mb-5 bg-white rounded"
                    style="font-family: Aparajita;font-size: 25px;direction:rtl;width:90%;">
                    <h2 class="text-center" style="font-family: Aparajita;font-size: 30px;direction:rtl;">مصلحة
                        الإدارة</h2>

                    <div class="card-header" id="heading1_a" style="direction:rtl;text-align: right;font-size: 28px;">
                        <h5 class="mb-0 mr-0">
                            <button class="btn btn-link collapsed d1_a" data-toggle="collapse"
                                style="direction:rtl;text-align: right;font-size: 28px;" data-target="#collapse1_a"
                                aria-expanded="true" aria-controls="collapse1_a">
                                تعليمة خاصة بالأختام الدائرية للمؤسسة
                        </h5>
                    </div>

                    <div id="collapse1_a" class="collapse " aria-labelledby="heading1_a" data-parent="#accordion">
                        <div class="card-body row" style="text-align: right;">

                            <div class="row" style="margin:0 25px">
                            <img src="{{ asset('assets/image/a1.jpg') }}" alt="" width="80%"
                            height="100%"> 
                        </div>
                        </div>
                    </div>

                </div> 
            @endif
            @if (Illuminate\Support\Facades\Auth::user()->service == 99 || Illuminate\Support\Facades\Auth::user()->service == 2)
                <div id="accordion" class=" col-12 shadow p-3 mb-5 bg-white rounded"
                    style="font-family: Aparajita;font-size: 25px;direction:rtl;width:90%;">
                    <h2 class="text-center" style="font-family: Aparajita;font-size: 30px;direction:rtl;">مصلحة
                        الاستغلال</h2>

                    <div class="card-header" id="heading9" style="direction:rtl;text-align: right;font-size: 28px;">
                        <h5 class="mb-0 mr-0">
                            <button class="btn btn-link collapsed d9" data-toggle="collapse"
                                style="direction:rtl;text-align: right;font-size: 28px;" data-target="#collapse9"
                                aria-expanded="true" aria-controls="collapse9">
                                التعليمة رقم 36 المؤرخة في 2023/10/10 <br>
                                المتعلقة بتنظيم العمل في مصلحة الاستغلال </button>
                        </h5>
                    </div>

                    <div id="collapse9" class="collapse " aria-labelledby="heading9" data-parent="#accordion">
                        <div class="card-body row" style="text-align: center;">

                            <div class="row" style="margin:auto">
                                <img src="{{ asset('assets/image/t9.jpg') }}" alt="" width="80%"
                                    height="100%">

                            </div>
                        </div>
                    </div>
                    <div class="card-header" id="heading8" style="direction:rtl;text-align: right;font-size: 28px;">
                        <h5 class="mb-0 mr-0">
                            <button class="btn btn-link collapsed d8" data-toggle="collapse"
                                style="direction:rtl;text-align: right;font-size: 28px;" data-target="#collapse8"
                                aria-expanded="true" aria-controls="collapse8">
                                التعليمة رقم 34 المؤرخة في 2023/09/26 <br>
                                المتعلقة بتنظيم دفع المداخيل للتذاكر</button>
                        </h5>
                    </div>

                    <div id="collapse8" class="collapse " aria-labelledby="heading8" data-parent="#accordion">
                        <div class="card-body row" style="text-align: center;">

                            <div class="row" style="margin:auto">
                                <img src="{{ asset('assets/image/t8.jpg') }}" alt="" width="80%"
                                    height="100%">


                            </div>
                        </div>
                    </div>
                    <div class="card-header" id="heading1" style="direction:rtl;text-align: right;font-size: 28px;">
                        <h5 class="mb-0 mr-0">
                            <button class="btn btn-link collapsed d1" data-toggle="collapse"
                                style="direction:rtl;text-align: right;font-size: 28px;" data-target="#collapse1"
                                aria-expanded="true" aria-controls="collapse1">
                                التعليمة رقم 180 / 2018 المؤرخة في 2018/12/02 <br>
                                المتعلقة ببطاقة الاشتراك الموحد حافلة - ترامواي</button>
                        </h5>
                    </div>

                    <div id="collapse1" class="collapse " aria-labelledby="heading1" data-parent="#accordion">
                        <div class="card-body row" style="text-align: center;">

                            <div class="row" style="margin:auto">
                                <img src="{{ asset('assets/image/t1.jpg') }}" alt="" width="80%"
                                    height="100%">
                                <img src="{{ asset('assets/image/joint.jpg') }}" alt="" width="80%"
                                    height="100%">

                            </div>
                        </div>
                    </div>
                    <div class="card-header" id="heading2" style="direction:rtl;text-align: right;font-size: 28px;">
                        <h5 class="mb-0 mr-0">
                            <button class="btn btn-link collapsed d2" data-toggle="collapse"
                                style="direction:rtl;text-align: right;font-size: 28px;" data-target="#collapse2"
                                aria-expanded="true" aria-controls="collapse2">
                                التعليمة رقم 21 المؤرخة في 2021/10/27 <br>
                                المتعلقة بحوادث المرور من طرف السائقين</button>
                        </h5>
                    </div>

                    <div id="collapse2" class="collapse " aria-labelledby="heading2" data-parent="#accordion">
                        <div class="card-body row" style="text-align: center;">

                            <div class="row" style="margin:auto">
                                <img src="{{ asset('assets/image/t2.jpg') }}" alt="" width="80%"
                                    height="100%">

                            </div>
                        </div>
                    </div>


                    <div class="card-header" id="heading3" style="direction:rtl;text-align: right;font-size: 28px;">
                        <h5 class="mb-0 mr-0">
                            <button class="btn btn-link collapsed d3" data-toggle="collapse"
                                style="direction:rtl;text-align: right;font-size: 28px;" data-target="#collapse3"
                                aria-expanded="true" aria-controls="collapse3">
                                التعليمة رقم 13 المؤرخة في 2022/06/22 <br>
                                المتعلقة بفرض النظام بأماكن العمل من طرف مسؤولي الاستغلال</button>
                        </h5>
                    </div>

                    <div id="collapse3" class="collapse " aria-labelledby="heading3" data-parent="#accordion">
                        <div class="card-body row" style="text-align: center;">

                            <div class="row" style="margin:auto">
                                <img src="{{ asset('assets/image/t3.jpg') }}" alt="" width="80%"
                                    height="100%">

                            </div>
                        </div>
                    </div>

                    <div class="card-header" id="heading4" style="direction:rtl;text-align: right;font-size: 28px;">
                        <h5 class="mb-0 mr-0">
                            <button class="btn btn-link collapsed d4" data-toggle="collapse"
                                style="direction:rtl;text-align: right;font-size: 28px;" data-target="#collapse4"
                                aria-expanded="true" aria-controls="collapse4">
                                التعليمة رقم 15 المؤرخة في 2022/07/03 <br>
                                المتعلقة بضرورة التحاق المراقبين ورؤساء المحطات بمقر <br>المؤسسة خلال الفترة الصباحية و
                                المسائية</button>
                        </h5>
                    </div>

                    <div id="collapse4" class="collapse " aria-labelledby="heading4" data-parent="#accordion">
                        <div class="card-body row" style="text-align: center;">

                            <div class="row" style="margin:auto">
                                <img src="{{ asset('assets/image/t4.jpg') }}" alt="" width="80%"
                                    height="100%">

                            </div>
                        </div>
                    </div>
                    <div class="card-header" id="heading5" style="direction:rtl;text-align: right;font-size: 28px;">
                        <h5 class="mb-0 mr-0">
                            <button class="btn btn-link collapsed d5" data-toggle="collapse"
                                style="direction:rtl;text-align: right;font-size: 28px;" data-target="#collapse5"
                                aria-expanded="true" aria-controls="collapse5">
                                التعليمة رقم 21 المؤرخة في 2022/10/30 <br>
                                المتعلقة بعملية الدفع الالكتروني</button>
                        </h5>
                    </div>

                    <div id="collapse5" class="collapse " aria-labelledby="heading5" data-parent="#accordion">
                        <div class="card-body row" style="text-align: center;">

                            <div class="row" style="margin:auto">
                                <img src="{{ asset('assets/image/t5.jpg') }}" alt="" width="80%"
                                    height="100%">

                            </div>
                        </div>
                    </div>

                    <div class="card-header" id="heading6" style="direction:rtl;text-align: right;font-size: 28px;">
                        <h5 class="mb-0 mr-0">
                            <button class="btn btn-link collapsed d6" data-toggle="collapse"
                                style="direction:rtl;text-align: right;font-size: 28px;" data-target="#collapse6"
                                aria-expanded="true" aria-controls="collapse6">
                                التعليمة رقم 03 المؤرخة في 2023/01/29 <br>
                                المتعلقة بمراقبة اللوحات الالكترونية</button>
                        </h5>
                    </div>

                    <div id="collapse6" class="collapse " aria-labelledby="heading6" data-parent="#accordion">
                        <div class="card-body row" style="text-align: center;">

                            <div class="row" style="margin:auto">
                                <img src="{{ asset('assets/image/t6.jpg') }}" alt="" width="80%"
                                    height="100%">

                            </div>
                        </div>
                    </div>

                    <div class="card-header" id="heading7" style="direction:rtl;text-align: right;font-size: 28px;">
                        <h5 class="mb-0 mr-0">
                            <button class="btn btn-link collapsed d7" data-toggle="collapse"
                                style="direction:rtl;text-align: right;font-size: 28px;" data-target="#collapse7"
                                aria-expanded="true" aria-controls="collapse7">
                                التعليمة رقم 18 المؤرخة في 2023/05/07 <br>
                                المتعلقة بخطر الاخلال بالنظام العام واثارة الفوضى بأماكن العمل</button>
                        </h5>
                    </div>

                    <div id="collapse7" class="collapse " aria-labelledby="heading7" data-parent="#accordion">
                        <div class="card-body row" style="text-align: center;">

                            <div class="row" style="margin:auto">
                                <img src="{{ asset('assets/image/t7.jpg') }}" alt="" width="80%"
                                    height="100%">

                            </div>
                        </div>
                    </div>

                </div>
            @endif
            @if (Illuminate\Support\Facades\Auth::user()->service == 99 || Illuminate\Support\Facades\Auth::user()->service == 3)
                <!-- <div id="accordion" class=" col-12 shadow p-3 mb-5 bg-white rounded"
            style="font-family: Aparajita;font-size: 25px;direction:rtl;width:90%;">
            <h2 class="text-center" style="font-family: Aparajita;font-size: 30px;direction:rtl;">مصلحة
                        المحاسبة والمالية</h2>
            <div class="card-header" id="heading1" style="direction:rtl;text-align: right;font-size: 28px;">
                <h5 class="mb-0 mr-0">
                    <button class="btn btn-link collapsed d1" data-toggle="collapse"
                        style="direction:rtl;text-align: right;font-size: 28px;" data-target="#collapse1"
                        aria-expanded="true" aria-controls="collapse1">
                        العنوان
                </h5>
            </div>

            <div id="collapse1" class="collapse " aria-labelledby="heading1" data-parent="#accordion">
                <div class="card-body row" style="text-align: right;">

                    <div class="row" style="margin:0 25px">
                       المحتوى
                    </div>
                </div>
            </div>

        </div> -->
            @endif
            @if (Illuminate\Support\Facades\Auth::user()->service == 99 || Illuminate\Support\Facades\Auth::user()->service == 4)
                <!-- <div id="accordion" class=" col-12 shadow p-3 mb-5 bg-white rounded"
            style="font-family: Aparajita;font-size: 25px;direction:rtl;width:90%;">
            <h2 class="text-center" style="font-family: Aparajita;font-size: 30px;direction:rtl;">مصلحة
                        الصيانة</h2>
            <div class="card-header" id="heading1" style="direction:rtl;text-align: right;font-size: 28px;">
                <h5 class="mb-0 mr-0">
                    <button class="btn btn-link collapsed d1" data-toggle="collapse"
                        style="direction:rtl;text-align: right;font-size: 28px;" data-target="#collapse1"
                        aria-expanded="true" aria-controls="collapse1">
                        العنوان
                </h5>
            </div>

            <div id="collapse1" class="collapse " aria-labelledby="heading1" data-parent="#accordion">
                <div class="card-body row" style="text-align: right;">

                    <div class="row" style="margin:0 25px">
                       المحتوى
                    </div>
                </div>
            </div>

        </div> -->
            @endif
            @if (Illuminate\Support\Facades\Auth::user()->service == 99 || Illuminate\Support\Facades\Auth::user()->service == 5)
                <!-- <div id="accordion" class=" col-12 shadow p-3 mb-5 bg-white rounded"
            style="font-family: Aparajita;font-size: 25px;direction:rtl;width:90%;">
            <h2 class="text-center" style="font-family: Aparajita;font-size: 30px;direction:rtl;">مصلحة
                        تسيير المخزونات</h2>
            <div class="card-header" id="heading1" style="direction:rtl;text-align: right;font-size: 28px;">
                <h5 class="mb-0 mr-0">
                    <button class="btn btn-link collapsed d1" data-toggle="collapse"
                        style="direction:rtl;text-align: right;font-size: 28px;" data-target="#collapse1"
                        aria-expanded="true" aria-controls="collapse1">
                        العنوان
                </h5>
            </div>

            <div id="collapse1" class="collapse " aria-labelledby="heading1" data-parent="#accordion">
                <div class="card-body row" style="text-align: right;">

                    <div class="row" style="margin:0 25px">
                       المحتوى
                    </div>
                </div>
            </div>

        </div> -->
            @endif
        </div>
    @else
        @php
            header('Location: /dashboard');
            exit;
        @endphp
    @endif

</section><!-- End Testimonials Section -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js" defer></script>
