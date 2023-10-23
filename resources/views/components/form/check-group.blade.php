<div @if (isset($mb)) class="mb-{{ $mb }} col-{{ $col }}" @else class="mb-3 col-{{ $col }}" @endif>
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