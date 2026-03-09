<form id="customer_form" method="POST"
      action="{{ $customer ? route('developer.advancedCrud.update') : route('developer.advancedCrud.store') }}"
      data-after="{{ route('developer.advancedCrud.index') }}" enctype="multipart/form-data">
    @csrf
    <input value="{{ $customer ? $customer->id : 0 }}" name="customer_id" type="hidden"/>

    <div class="row">
        {{-- Column 1: Basic Info --}}
        <div class="col-md-4">
            {{-- type --}}
            <div class="_input_group mb-3">
                <label class="form-label fw-bold required">Type</label>
                <select name="type" class="form-select" data-control="select2" data-placeholder="Select Type">
                    <option @if($customer && $customer->type == 'customer') selected @endif value="customer">Customer</option>
                    <option @if($customer && $customer->type == 'guardian') selected @endif value="guardian">Guardian</option>
                </select>
                <div class="_laravel_error text-danger mt-1"></div>
            </div>

            {{-- name --}}
            <div class="_input_group mb-3">
                <label class="form-label fw-bold required">Name</label>
                <input value="{{ $customer ? $customer->name : '' }}" name="name" type="text"
                       class="form-control" placeholder="Enter customer name"/>
                <div class="_laravel_error text-danger mt-1"></div>
            </div>

            {{-- profession --}}
            <div class="_input_group mb-3">
                <label class="form-label fw-bold">Profession</label>
                <input value="{{ $customer ? $customer->profession : '' }}" name="profession" type="text"
                       class="form-control" placeholder="Enter profession"/>
                <div class="_laravel_error text-danger mt-1"></div>
            </div>

            {{-- dob --}}
            <div class="_input_group mb-3">
                <label class="form-label fw-bold required">Date of Birth</label>
                <input value="{{ $customer ? $customer->dob?->format('Y-m-d') : '' }}" name="dob" type="text"
                       class="form-control date_picker" placeholder="1990-01-30"/>
                <div class="_laravel_error text-danger mt-1"></div>
            </div>

            {{-- Switches row --}}
            <div class="row">
                <div class="col-6">
                    {{-- is_vip --}}
                    <div class="_input_group mb-3">
                        <label class="form-label fw-bold">VIP</label>
                        <div class="form-check form-switch">
                            <input name="is_vip" type="hidden" value="0"/>
                            <input @if($customer && $customer->is_vip) checked @endif
                                   name="is_vip" class="form-check-input" type="checkbox" value="1"/>
                        </div>
                        <div class="_laravel_error text-danger mt-1"></div>
                    </div>
                </div>
                <div class="col-6">
                    {{-- banned_at --}}
                    <div class="_input_group mb-3">
                        <label class="form-label fw-bold">Banned</label>
                        <div class="form-check form-switch">
                            <input name="banned_at" type="hidden" value="0"/>
                            <input @if($customer && $customer->banned_at) checked @endif
                                   name="banned_at" class="form-check-input" type="checkbox" value="1"/>
                        </div>
                        <div class="_laravel_error text-danger mt-1"></div>
                    </div>
                </div>
            </div>

            {{-- gender --}}
            <div class="_input_group mb-3">
                <label class="form-label fw-bold required">Gender</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input @if($customer && $customer->gender == 'male') checked @endif
                               name="gender" class="form-check-input" type="radio" value="male" id="gender_male"/>
                        <label class="form-check-label" for="gender_male">Male</label>
                    </div>
                    <div class="form-check">
                        <input @if($customer && $customer->gender == 'female') checked @endif
                               name="gender" class="form-check-input" type="radio" value="female" id="gender_female"/>
                        <label class="form-check-label" for="gender_female">Female</label>
                    </div>
                </div>
                <div class="_laravel_error text-danger mt-1"></div>
            </div>

            {{-- color --}}
            <div class="_input_group mb-3">
                <label class="form-label fw-bold">Favorite Color</label>
                <input value="{{ $customer ? $customer->color : '#3b82f6' }}" name="color" type="color"
                       class="form-control form-control-color" style="width: 60px; height: 40px;"/>
                <div class="_laravel_error text-danger mt-1"></div>
            </div>
        </div>

        {{-- Column 2: Contact Info --}}
        <div class="col-md-4">
            {{-- email --}}
            <div class="_input_group mb-3">
                <label class="form-label fw-bold required">Email</label>
                <input value="{{ $customer ? $customer->email : '' }}" name="email" type="email"
                       class="form-control email_mask" placeholder="example@example.com"/>
                <div class="_laravel_error text-danger mt-1"></div>
            </div>

            {{-- password --}}
            <div class="_input_group mb-3">
                <label class="form-label fw-bold {{ $customer ? '' : 'required' }}">Password</label>
                <div class="input-group">
                    <input class="form-control" type="password" name="password" autocomplete="new-password"
                           placeholder="{{ $customer ? 'Leave empty to keep current' : 'Min 8 characters' }}"/>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword(this)">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                <small class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</small>
                <div class="_laravel_error text-danger mt-1"></div>
            </div>

            {{-- mobile --}}
            <div class="_input_group mb-3">
                <label class="form-label fw-bold">Mobile</label>
                <input value="{{ $customer ? $customer->mobile : '' }}" name="mobile" type="text"
                       class="form-control" placeholder="05x-xxx-xxxx"/>
                <div class="_laravel_error text-danger mt-1"></div>
            </div>

            {{-- civil_id --}}
            <div class="_input_group mb-3">
                <label class="form-label fw-bold required">ID No</label>
                <input value="{{ $customer ? $customer->civil_id : '' }}" name="civil_id" type="text"
                       class="form-control" placeholder="Enter ID number"/>
                <div class="_laravel_error text-danger mt-1"></div>
            </div>

            {{-- passport_no --}}
            <div class="_input_group mb-3">
                <label class="form-label fw-bold">Passport No</label>
                <input value="{{ $customer ? $customer->passport_no : '' }}" name="passport_no" type="text"
                       class="form-control" placeholder="Enter passport number"/>
                <div class="_laravel_error text-danger mt-1"></div>
            </div>

            {{-- address --}}
            <div class="_input_group mb-3">
                <label class="form-label fw-bold">Address</label>
                <input value="{{ $customer ? $customer->address : '' }}" name="address" type="text"
                       class="form-control" placeholder="Enter address"/>
                <div class="_laravel_error text-danger mt-1"></div>
            </div>
        </div>

        {{-- Column 3: Image Upload --}}
        <div class="col-md-4">
            {{-- Profile Image --}}
            <div class="_input_group mb-4">
                <label class="form-label fw-bold">Profile Image</label>
                <div class="text-center">
                    <div class="mb-3">
                        <img id="img_preview" src="{{ $customer ? $customer->img_url : getDefaultImg() }}"
                             class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #eee;"/>
                    </div>
                    <input name="img" type="file" class="form-control" accept="image/*"
                           onchange="previewImage(this, 'img_preview')"/>
                </div>
                <div class="_laravel_error text-danger mt-1"></div>
            </div>

            {{-- Civil ID Image --}}
            <div class="_input_group mb-3">
                <label class="form-label fw-bold">Civil ID Image</label>
                <div class="text-center">
                    <div class="mb-3">
                        <img id="civil_id_img_preview"
                             src="{{ $customer && $customer->civil_id_img ? getImageUrl(\App\Models\Developer\AdvancedCrud::MEDIA_PATH, $customer->civil_id_img) : getDefaultImg() }}"
                             class="rounded" style="width: 200px; height: 120px; object-fit: cover; border: 3px solid #eee;"/>
                    </div>
                    <input name="civil_id_img" type="file" class="form-control" accept="image/*"
                           onchange="previewImage(this, 'civil_id_img_preview')"/>
                </div>
                <div class="_laravel_error text-danger mt-1"></div>
            </div>
        </div>
    </div>
</form>

<script>
    function togglePassword(btn) {
        var input = btn.parentElement.querySelector('input');
        var icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
