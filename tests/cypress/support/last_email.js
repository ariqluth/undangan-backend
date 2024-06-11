app.get('/last-email', async (req, res) => {
    // Query mailhog API
    const { items } = await rp({
      method: 'GET',
      url: 'http://localhost:8025/api/v2/search',
      headers: {
        'content-type': 'application/json',
      },
      qs: {
        kind: 'to',
        query: decodeURIComponent(req.query.email),
      },
      json: true,
    });

    const lastEmail = items[0];

    if (lastEmail) {
      res.send(lastEmail.Content.Body);
    } else {
      res.send(null);
    }
  });
