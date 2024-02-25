<script>
    flatpickr('#date', {
        enableTime: false, // If you want to enable time as well
        dateFormat: "Y-m-d", // Specify your desired date format
        placeholder: "ရက်စွဲရွေးချယ်ပါ။",
        disableMobile: "true"
    });
    $('.select2').select2({
        width: '100%',
        placeholder: "‌ရွေးချယ်ပါ"
    });
    $('#remark').summernote({
        placeholder: 'မှတ်ချက် ရေးသားပါ။',
        height: 100,
        toolbar: false
    });
</script>