<div class="card">
    <div class="card-header">{{ __('قائمة المهام') }}</div>

    <div class="card-body">
        {{ $slot }}
            
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div id="trash" class="grid-trash">
                    اسحب <b>مهمة</b> أو <b>صندوق مهام</b> هنا لحذفه
                    <br/>
                    فى حالة سحب <b>صندوق مهام</b> سيتم حذفة وسيتم حذف مابداخلة من <b>مهام</b>
                </div>
            </div>
        </div>
    </div>
</div>