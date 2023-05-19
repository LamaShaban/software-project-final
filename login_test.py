import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

class LoginTestCase(unittest.TestCase):

    def setUp(self):
        self.driver = webdriver.Edge()  # Assuming you are using Microsoft Edge browser
        self.driver.get("http://localhost/software%20project/login.php")  

    def tearDown(self):
        self.driver.quit()

    def test_valid_login(self):
        # Test case for valid login
        username_input = self.driver.find_element(By.ID, "name")
        password_input = self.driver.find_element(By.ID, "pass")
        submit_button = self.driver.find_element(By.ID, "submit")

        username_input.send_keys("lama shaban")
        password_input.send_keys("123456")
        submit_button.click()



    def test_invalid_login(self):
        # Test case for invalid login
        username_input = self.driver.find_element(By.ID, "name")
        password_input = self.driver.find_element(By.ID, "pass")
        submit_button = self.driver.find_element(By.ID, "submit")

        username_input.send_keys("lanan")
        password_input.send_keys("12345")
        submit_button.click()



if __name__ == '__main__':
    unittest.main()
