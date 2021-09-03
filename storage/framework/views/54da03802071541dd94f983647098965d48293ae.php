<script>
    var calendar;
    $(document).ready(function(){
        var calendarEl = document.getElementById('calendar-<?php echo e($id); ?>')
        calendar = new FullCalendar.Calendar(calendarEl,
            <?php echo $options; ?>,
        );
        calendar.render();
    });
</script>
<?php /**PATH /var/www/shosa/vendor/acaronlex/laravel-calendar/src/views//script.blade.php ENDPATH**/ ?>