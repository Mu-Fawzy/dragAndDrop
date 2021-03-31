<div class="card">
    <div class="card-header">{{ __('الاقسام') }}</div>

    <div class="card-body">
        {{ $slot }}
            
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div id="trash" class="grid-trash">
                    اسحب <b>عنصر</b> أو <b>قسم</b> هنا لحذفه
                    <br/>
                    فى حالة سحب <b>قسم</b> سيتم حذفة وسيتم حذف مابداخلة من <b>عناصر</b>
                </div>
            </div>
        </div>
    </div>
</div>