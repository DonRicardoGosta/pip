CREATE TABLE detouravis (
	id serial PRIMARY KEY,
	parcel_number VARCHAR ( 50 ) NOT NULL,
	type VARCHAR ( 3 ) NOT NULL,
	delivery_day DATE NOT NULL,
	insert_date TIMESTAMP NOT NULL
);

INSERT INTO detouravis(parcel_number, type, delivery_day, insert_date)
VALUES (06086219446181, 1, '2023-05-01', now()),
       (06086219446182, 1, '2023-05-01', now()),
       (06086219446183, 2, '2023-05-02', now()),
       (06086219446184, 3, '2023-05-02', now()),
       (06086219446185, 3, '2023-05-03', now()),
       (06086219446186, 2, '2023-05-04', now()),
       (06086219446187, 3, '2023-05-05', now()),
       (06086219446188, 1, '2023-05-05', now()),
       (06086219446189, 1, '2023-05-06', now());
