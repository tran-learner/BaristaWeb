const express = require('express');
const PayOS = require('@payos/node');

const payos = new PayOS('f7fd9da0-26fb-4336-ac57-cc5f623b8224','83d3f939-9f77-4ba3-a760-64de113f2b84','9ca62a9e76e8cb3e2715e1ce5946a505b87b2b0f0306b8fe0e4304a8ba1cebf5');
const app = express();
app.use(express.static('public'));
app.use(express.json());


app.post('/create-payment-link',async(req,res)=>{
    const YOUR_DOMAIN = 'http://localhost:8000';
    order = {
        amount: 2000,
        description: 'Thanh toan mi tom',
        orderCode: 3,
        returnUrl:'http://localhost:8000',
        cancelUrl: 'http://localhost:8000'
    };
    const paymentLink=await payos.createPaymentLink(order);
    res.redirect(303,paymentLink.checkoutUrl)
})

app.listen(3000,()=>console.log('running on port 3000'));