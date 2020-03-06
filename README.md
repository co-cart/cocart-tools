# CoCart - Tools

![CoCart Logo](https://cocart.xyz/wp-content/uploads/2019/09/Logo-1024x534.jpg.webp)

Provides tools to help with testing when developing with CoCart.

## Features

* View current session.
* Destroy session and empty cart. ( This is the same as logging out the current user. )
* Forget session without destroying it and empty cart.
* Clean-up session data from the database and clear caches.

## Endpoints

* Get Session - `cocart/v1/tools/get-session` (POST-METHOD: GET)
* Destroy Session - `cocart/v1/tools/destroy-session` (POST-METHOD: POST)
* Forget Session - `cocart/v1/tools/forget-session` (POST-METHOD: POST)
* Clean-up Sessions - `cocart/v1/tools/cleanup-sessions` (POST-METHOD: POST)

## Example

What you could get when getting the current session of a logged in user.

```json
{
    "current_user_id": 1,
    "customer_id": "1",
    "loading_from": "database",
    "session_cookies": {
        "customer_id": "1",
        "session_expiration": "1583684333",
        "session_expiring": "1583680733",
        "cookie_hash": "e7ab418365fa6210645b7304d324012e"
    },
    "session_data": {
        "cart": {
            "6364d3f0f495b6ab9dcf8d3b5c6e0b01": {
                "key": "6364d3f0f495b6ab9dcf8d3b5c6e0b01",
                "product_id": 32,
                "variation_id": 0,
                "variation": [],
                "quantity": 6,
                "data_hash": "b5c1d5ca8bae6d4896cf1807cdf763f0",
                "line_tax_data": {
                    "subtotal": {
                        "13": 50.4
                    },
                    "total": {
                        "13": 50.4
                    }
                },
                "line_subtotal": 252,
                "line_subtotal_tax": 50.4,
                "line_total": 252,
                "line_tax": 50.4
            }
        },
        "cart_totals": {
            "subtotal": "252.00",
            "subtotal_tax": 50.4,
            "shipping_total": "33.00",
            "shipping_tax": 6.6,
            "shipping_taxes": {
                "13": 6.6
            },
            "discount_total": 0,
            "discount_tax": 0,
            "cart_contents_total": "252.00",
            "cart_contents_tax": 50.4,
            "cart_contents_taxes": {
                "13": 50.4
            },
            "fee_total": "0.00",
            "fee_tax": 0,
            "fee_taxes": [],
            "total": "342.00",
            "total_tax": 57
        },
        "applied_coupons": [],
        "coupon_discount_totals": [],
        "coupon_discount_tax_totals": [],
        "removed_cart_contents": [],
        "cart_fees": [],
        "shipping_for_package_0": {
            "package_hash": "wc_ship_b8ae17c59ac0fb797f42859390038a31",
            "rates": {
                "flat_rate:1": {},
                "free_shipping:3": {}
            }
        },
        "previous_shipping_methods": [
            [
                "flat_rate:1",
                "free_shipping:3"
            ]
        ],
        "chosen_shipping_methods": [
            "flat_rate:1"
        ],
        "shipping_method_counts": [
            2
        ],
        "customer": {
            "id": "0",
            "date_modified": "",
            "postcode": "",
            "city": "",
            "address_1": "",
            "address": "",
            "address_2": "",
            "state": "",
            "country": "GB",
            "shipping_postcode": "",
            "shipping_city": "",
            "shipping_address_1": "",
            "shipping_address": "",
            "shipping_address_2": "",
            "shipping_state": "",
            "shipping_country": "GB",
            "is_vat_exempt": "",
            "calculated_shipping": "",
            "first_name": "",
            "last_name": "",
            "company": "",
            "phone": "",
            "email": "",
            "shipping_first_name": "",
            "shipping_last_name": "",
            "shipping_company": ""
        },
        "cocart_customer_id": false
    },
    "cocart_key": null,
    "cocart_email": null,
    "notices": []
}
```

## Requirement

You will need to be using CoCart **v2.x.x** and up before installing this add-on.

## Installation

Download the latest release and upload to your WordPress dashboard via the plugins page and then activate.

## Bugs

If you find an issue, please report on the issues tab. Thank you.