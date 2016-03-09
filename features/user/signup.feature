Feature: Signup an user

  Scenario: Signup an user
    Given I filled all the signup data
    When I signup
    Then the user must be registered

  Scenario: Signup an user with wrong data
    Given I filled wrong signup data
    When I signup
    Then the user must not be registered
    And a wrong data error must be raised