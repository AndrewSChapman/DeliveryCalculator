database name: deliverycalculator
username: demo
password: E.4VJ#xz.(c|5L!B


region
-----------
id
region_name

supplier
-----------
id
name

supplier_delivery_day
------------------------
id
supplier_id
day_no (0 = sun, 6 = saturday)
start_time
end_time

supplier_delivery_region
------------------------------
supplier_id
region_id
num_business_days

country
-------------
id
name
region_id

address
--------------
id
street_line_1
street_line_2
city
county
postcode
country_id
created_at
updated_at

customer
--------------
id
first_name
last_name
created_at
updated_at

customer_address
-------------------
customer_id
address_id
address_name (e.g. home, work)
is_primary_delivery_address
created_at
updated_at

product
------------------
id
sku
name
num_in_stock
cost
price
created_at
updated_at

order
-----------
id
created_at
updated_at
status (enum: pending, paid, posted, cancelled, refunded)
customer_id
delivery_address_id
estimated_delivery_date
tracking_number
order_total_amount_ex_tax
order_tax_amount


order_item
--------------
id
order_id
product_id
price
tax_amount
qty
total_amount
total_tax_amount


