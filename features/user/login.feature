Feature: Login an user

  Scenario: Login an user
    Given a registered user
    When I login
    Then the user is logged

  Scenario: Login a not registered user
    Given a not registered user
    When I login
    Then the user is not logged
    And a user not found error must be raised
