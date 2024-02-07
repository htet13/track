<script>
    flatpickr('#date', {
        enableTime: false, // If you want to enable time as well
        dateFormat: "Y-m-d", // Specify your desired date format
        placeholder: "To Date"
    });
    $('#car_no_id').select2({
        width: '100%',
        placeholder: "‌ရွေးချယ်ပါ"
    });
    $('#fromcities').select2({
        width: '100%',
        placeholder: "‌ရွေးချယ်ပါ"
    });
    $('#tocities').select2({
        width: '100%',
        placeholder: "‌ရွေးချယ်ပါ"
    });
    $('#issuer_id').select2({
        width: '100%',
        placeholder: "‌ရွေးချယ်ပါ"
    });
    $('#driver_id').select2({
        width: '100%',
        placeholder: "‌ရွေးချယ်ပါ"
    });
    $('#spare_id').select2({
        width: '100%',
        placeholder: "‌ရွေးချယ်ပါ"
    });
    $('#drive_fee').select2({
        width: '100%',
        placeholder: "‌ရွေးချယ်ပါ"
    });
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200
        });
    });
</script>