<table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col"><b>Reference #</b></th>
        <th scope="col"><b>Patient</b></th>
        <th scope="col"><b>Centers</b></th>
        <th scope="col"><b>Services</b></th>
        <th scope="col"><b>Status</b></th>
        <th scope="col"><b>Mode of Payment</b></th>
      </tr>
    </thead>
    <tbody>
      @if(count($bookings) > 0)
          @foreach($bookings as $booking)
          <tr>
              <td><a href="{{ route('admin.servicesBooking.show', $booking) }}">{{ $booking->booking_reference_no }}</a></td>
              <td>{{ $booking->patient->name }}</td>
              <td>
                  <ul>
                      @foreach($booking->bookingCenters as $bookingCenter)
                          <li>
                              {{ $bookingCenter->name }} ({{ $bookingCenter->available_date_time }})
                          </li>
                      @endforeach
                  </ul>
              </td>
              <td>
                  <ul>
                      @foreach($booking->bookingServices as $bookingService)
                          <li>
                              {{ $bookingService->name }} <span class="badge {{$bookingService->status}}">{{ ucfirst($bookingService->status) }}</span>
                          </li>
                      @endforeach
                  </ul>
              </td>
              <td><span class="badge {{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
              <td>{{ config('telemed.mode_of_payment')[$booking->mode_of_payment] }}</td>
          </tr>
          @endforeach
      @else
          <tr><td class="text-center" colspan="6">No records found.</td></tr>
      @endif
     </tbody>
  </table>
