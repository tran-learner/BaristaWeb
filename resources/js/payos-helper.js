const { PayOS } = require('@payos/node');

const payos = new PayOS(
  process.env.PAYOS_CLIENT_ID,
  process.env.PAYOS_API_KEY,
  process.env.PAYOS_CHECKSUM_KEY
);

// Function to create payment link
async function createPaymentLink(orderData) {
  try {
    const paymentLink = await payos.createPaymentLink(orderData);
    return paymentLink;
  } catch (error) {
    throw error;
  }
}

// Export functions to be used by PHP
module.exports = { createPaymentLink };