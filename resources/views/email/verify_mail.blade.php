
@includeWhen($receiver == 'client', 'email.to_client')

@includeWhen($receiver == 'back_office', 'email.to_back_office')