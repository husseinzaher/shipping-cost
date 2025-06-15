# O2Mart Shipping Cost API

A Laravel-based RESTful API to calculate shipping costs according to **Jeebly** courier rules.

---

## 📋 Prerequisites

- PHP >= 8.0
- Composer
- Laravel 9.x or 10.x
- MySQL (optional – for logging or area data)
- Git

---

## 🚀 Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/husseinzaher/shipping-cost
   cd shipping-cost
   ```

2. **Install Dependencies**

   ```bash
   composer install
   ```

3. **Setup Environment**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure `.env`**

    - Update your database credentials.

5. **Run Migrations and Seeders**

   ```bash
   php artisan migrate --seed
   ```

---

## 🔧 Usage

### 1. Serve the API Locally

```bash
php artisan serve
```

Default URL: `http://127.0.0.1:8000`

---

### 2. Endpoints

#### 🧮 Calculate Shipping Cost

- **POST** `/api/v1/shipping/cost`

**Headers:**
```http
Accept: application/json
Content-Type: application/json
```

**Sample Request:**
```json
{
  "area_type": "normal",
  "shipment_count": 501,
  "weight": 10,
  "length": 10,
  "width": 10,
  "height": 10
}
```

**Sample Response:**
```json
{
  "prices": {
    "baseCost": "AED 11.00",
    "extraWeight": "AED 5.00",
    "extraWeightCharge": "AED 10.00",
    "subtotal1": "AED 21.00",
    "fuel": "AED 0.42",
    "subtotal2": "AED 21.42",
    "packaging": "AED 5.25",
    "subtotal3": "AED 26.67",
    "epg": "AED 2.67",
    "subtotal4": "AED 29.34",
    "vat": "AED 1.47",
    "total": "AED 30.80"
  }
}
```

**cURL Example:**
```bash
curl -X POST http://127.0.0.1:8000/api/v1/shipping/cost \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "area_type": "normal",
    "shipment_count": 501,
    "weight": 10,
    "length": 10,
    "width": 10,
    "height": 10
  }'
```

---

#### 🗺️ Get Area Types

- **POST** `/api/v1/areas`

**Headers:**
```http
Accept: application/json
Content-Type: application/json
```

**Sample Request:**
```json
{
  "area_type": "remote"
}
```

**cURL Example:**
```bash
curl -X GET http://127.0.0.1:8000/api/v1/areas \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "area_type": "remote"
  }'
```

---

## 🧪 Testing

To run the test suite:

```bash
php artisan test
```

Feature tests for the `/api/v1/shipping/cost` endpoint should be added under `tests/Feature`.

---

## 👨‍💻 Author

Developed by **Hussein Zaher**  
GitHub: [@husseinzaher](https://github.com/husseinzaher)

---

## 📄 License

This project is open-sourced under the [MIT License](LICENSE).
