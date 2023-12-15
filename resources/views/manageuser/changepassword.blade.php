<form action="{{ route('updatepassword')}}" method="post" id="updatepassword" name="updatepassword" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Old Password<span class="text-danger">*</span></label>
                    <input name="oldpassword" type="password" class="form-control" id="oldpassword" placeholder="Enter Old Password">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="">
                    <label for=""> New Password<span class="text-danger">*</span></label>
                    <input name="newpassword" type="password" class="form-control" id="newpassword" placeholder="Enter New Password">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Confirm Password<span class="text-danger">*</span></label>
                    <input name="cpassword" type="password" class="form-control" id="cpassword" placeholder="Confirm New Password">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-md-6">
                <button onclick="validate()" name="submit" id="submit-edit" type="submit" class="btn btn-block bg-gradient-primary">Save New Password</button>
            </div>
        </div>
    </div>
</form>

<script>
  jQuery('#updatepassword').validate({
    rules: {
      opassword: {
        required: true,
        minlength: 8,
      },
      npassword: {
        required: true,
        minlength: 8,
      },
      cpassword: {
        required: true,
        minlength: 8,
        equalTo: "#npassword"
      }
    },
    messages: {
      oldpassword: {
        required: "Please enter your old password"
      },
      newpassword: {
        required: "Please enter your new password"
      },

      cpassword: {
        required: "Please re enter your new password"
      }
    },
    errorElement: 'span',
    errorPlacement: function(error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function(element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
</script>