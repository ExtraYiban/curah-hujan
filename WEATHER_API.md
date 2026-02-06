# Weather API Integration - BMKG

This Laravel application integrates with BMKG's weather API to provide real-time weather data for Samarinda.

## Features

- **Automatic Updates**: Weather data is automatically refreshed every 3 hours
- **Caching**: Data is cached to reduce API calls and improve response time
- **Manual Refresh**: Option to manually refresh weather data when needed

## API Endpoints

### Get Weather Data
```
GET /api/weather
```

Returns cached weather data for Samarinda (updated every 3 hours).

**Response:**
```json
{
  "success": true,
  "data": { /* BMKG weather data */ },
  "cached_at": "2026-02-06 14:00:00",
  "cache_expires_in": 165
}
```

### Manual Refresh
```
POST /api/weather/refresh
```

Forces a fresh fetch from BMKG API and updates the cache.

## Scheduled Tasks

The application automatically updates weather data every 3 hours using Laravel's task scheduler.

### Setup Scheduler (Production)

Add this cron entry to your server:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

### Manual Update

You can manually update weather data using:

```bash
php artisan weather:update
```

### Testing Scheduler (Development)

Run the scheduler locally:

```bash
php artisan schedule:work
```

## Cache Configuration

- **Cache Key**: `bmkg_weather_samarinda`
- **Cache Duration**: 3 hours (10,800 seconds)
- **Region Code**: 64.72.03.1002 (Samarinda, Kalimantan Timur)

## Usage in Frontend

The Vue component automatically fetches data from `/api/weather` which returns cached data updated every 3 hours:

```javascript
const response = await fetch('/api/weather')
const result = await response.json()
```

## BMKG API Details

- **Endpoint**: `https://api.bmkg.go.id/publik/prakiraan-cuaca`
- **Parameter**: `adm4=64.72.03.1002`
- **Location**: Samarinda Ulu, Kota Samarinda, Kalimantan Timur

## Weather Data Structure

The API returns:
- Temperature (°C)
- Weather conditions
- Rainfall amounts (mm)
- Humidity (%)
- Wind speed and direction
- Visibility
- 3-day hourly forecasts
