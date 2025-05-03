<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Date Range Picker Example</title>
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>
<body>

    <input type="text" class="form-control" id="date_range" name="date_range" placeholder="Select Date Range">


<script>
    flatpickr("#date_range", {
        mode: "range",
        dateFormat: "Y-m-d",
        onClose: function(selectedDates, dateStr, instance) {
            // Handle the selected date range here
            console.log("Selected dates:", selectedDates);
            console.log("Formatted date string:", dateStr);
        }
    });
    </script>
    
</script>

</body>
</html>
