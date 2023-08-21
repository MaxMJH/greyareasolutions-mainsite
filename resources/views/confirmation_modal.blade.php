<div id="confirmation-modal">
  <div id="modal-box">
    <h2>Confirmation</h2>
    <p>{{ $message }}@if (isset($user))<br><br>{{ $user->firstname }} {{ $user->lastname }}@endif</p>
    <div id="modal-options">
      <button type="submit" id="modal-confirm" name="modal-confirm">Confirm</button>
      <button type="button" id="modal-cancel" name="modal-cancel">Cancel</button>
    </div>
  </div>
</div>
