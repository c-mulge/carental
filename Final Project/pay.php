<script>
fetch('create_order.php') // Call the backend script
    .then(response => response.json())
    .then(order => {
        var options = {
            "key": "rzp_test_UTVyzQ3LlANHs0",
            "amount": order.amount,
            "currency": order.currency,
            "name": "Carental",
            "description": "Test Transaction",
            "image": "https://example.com/your_logo",
            "order_id": order.id, // Dynamically set order_id
            "callback_url": "payment_success.php",
            "prefill": {
                "name": "Gaurav Kumar",
                "email": "gaurav.kumar@example.com",
                "contact": "9000090000"
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button1').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }
    });
</script>
