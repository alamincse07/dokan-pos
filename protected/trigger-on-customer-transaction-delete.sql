
DELIMITER //
CREATE TRIGGER update_due_amount_for_customer_transaction_delete AFTER DELETE ON customer_transaction FOR EACH ROW
BEGIN-- Declare variables
	DECLARE
		last_due_amount DECIMAL ( 10, 2 );
	SELECT
		amount INTO last_due_amount 
	FROM
		customer_due_information 
	WHERE
		id = OLD.customer_id;
	IF
		OLD.transaction_type <> 'PAID' THEN
			SET last_due_amount = ( last_due_amount - OLD.amount );
	ELSE 
			SET last_due_amount = ( last_due_amount + OLD.amount );
	END IF;
	UPDATE customer_due_information 
	SET amount = last_due_amount
	WHERE
		id = OLD.customer_id;
	
END;
// DELIMITER;