@php
  if (! isset($mb))
    $mb = 3;
@endphp
<div class="mb-{{ $mb }} col-lg{{ $col }} col-md-{{ $col }} col-xs-12">
    <label class="form-label">Simple selectgroup</label>
    <div class="form-selectgroup">
      <label class="form-selectgroup-item">
        <input type="checkbox" name="name" value="HTML" class="form-selectgroup-input" checked="">
        <span class="form-selectgroup-label">HTML</span>
      </label>
      <label class="form-selectgroup-item">
        <input type="checkbox" name="name" value="CSS" class="form-selectgroup-input">
        <span class="form-selectgroup-label">CSS</span>
      </label>
      <label class="form-selectgroup-item">
        <input type="checkbox" name="name" value="PHP" class="form-selectgroup-input">
        <span class="form-selectgroup-label">PHP</span>
      </label>
      <label class="form-selectgroup-item">
        <input type="checkbox" name="name" value="JavaScript" class="form-selectgroup-input">
        <span class="form-selectgroup-label">JavaScript</span>
      </label>
    </div>
  </div>