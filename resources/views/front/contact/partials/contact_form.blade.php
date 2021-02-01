<form action="{{route('front.contact.send_message')}}" class="commenting-form" method="post"  role="form" >
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <input type="text" 
                    name="contact_person"
                   value="{{old('contact_person')}}"
                   placeholder="@lang('Your Name')" 
                   class="form-control @if($errors->has('contact_person')) is-invalid @endif">
            @include('front._layout.partials.form_errors', ['fieldName' => 'contact_person'])
        </div>
        <div class="form-group col-md-6">
            <input type="email"
                   name="contact_email"
                   value="{{old('contact_email')}}"
                   placeholder="@lang('Email Address (will not be published)')" 
                   class="form-control @if($errors->has('contact_email')) is-invalid @endif">
            @include('front._layout.partials.form_errors', ['fieldName' => 'contact_email'])
        </div>
        <div class="form-group col-md-12">
            <textarea placeholder="@lang('Type your message')" 
                      name="contact_message"
                      value="{{old('contact_message')}}"
                      class="form-control @if($errors->has('contact_message')) is-invalid @endif" 
                      rows="20"></textarea>
            @include('front._layout.partials.form_errors', ['fieldName' => 'contact_message'])
        </div>
        <div class="form-group col-md-6" >
            <div class="form-control @if($errors->has('g-recaptcha-response')) is-invalid @endif" id="recaptcha">

                {!! ReCaptcha::htmlFormSnippet() !!}
            </div> 

            @include('front._layout.partials.form_errors',['fieldName'=>'g-recaptcha-response'])


        </div>

        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-secondary">Submit Your Message</button>
        </div>
    </div>
</form>
@push('head_css')

@endpush

@push('footer_javascript')

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>

<script type="text/javascript">

    <script type="text/javascript">

    $('#main_contact_form').validate({
        "rules": {
            "contact_person": {
                "required": true,
                "minlength": 2,
                "maxlength": 255,
            },
            "contact_email": {
                "required": true,
                "email": true,
                "maxlength": 500,
            },
            "contact_message": {
                "required": true,
                "minlength": 50,
                "maxlength": 500
            }
        },
        submitHandler: function (form) {
            if (grecaptcha.getResponse()) {
                form.submit();
            } else {ed
                var recerror = $('<label id="recaptcha-error" class="error text-danger" for="g-recaptcha-response">This field is required.</label>');
                recerror.appendTo($('#recaptcha'));
                $('#recaptcha').addClass('is-invalid');
            }
        },
        "errorPlacement": function (error, element) {
            error.addClass('text-danger');
            error.insertAfter(element);

        }

    });

</script>

@endpush