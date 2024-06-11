const mailer = require('nodemailer');
const fs = require('fs');
const smtp = mailer.createTransport({
 host: '0.0.0.0',
 port: '1025',
 tls: {
    ciphers: 'SSLv3',
  },

});
app.post('/', (req, res) => {
    transporter.sendMail({
      from: 'hello@example.com',
      to: req.body.email,
      subject: 'Verify Email Address',
      // Very advanced verification link
      html: '<a href="http://localhost:8025/email/verify.html">Click me!</a>',
    });
    res.redirect('/sent.html');
  });

 smtp.sendMail(mailOptions, function(err, info) {
  if (!err) {
    console.log('Mail success: ' + info.response);
  } else {
    console.log('Mail err', err);
  }
  smtp.close();
 });
