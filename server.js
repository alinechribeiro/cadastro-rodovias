const express = require('express');
const axios = require('axios');
const cors = require('cors');

const app = express();

// Enable CORS for your frontend origin
app.use(cors({
  origin: 'http://127.0.0.1:8000'
}));

app.get('/api/dnit', async (req, res) => {
  try {
    const response = await axios.get('https://servicos.dnit.gov.br/sgplan/apigeo/rotas/espacializarlinha', {
      params: req.query
    });
    res.json(response.data);
  } catch (error) {
    console.error('Error:', error);
    res.status(500).json({ error: 'An error occurred while fetching data from DNIT API' });
  }
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`Proxy server running on port ${PORT}`));
