<table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col"><b>Reference #</b></th>
        <th scope="col"><b>Patient</b></th>
        <th scope="col"><b>Payment Ref #</b></th>
        <th scope="col"><b>Date of Payment</b></th>
        <th scope="col"><b>Mode of Payment</b></th>
        <th scope="col"><b>Payment</b></th>
      </tr>
    </thead>
    <tbody>
      @if(count($bookings) > 0)
          @foreach($bookings as $booking)
          <tr>
              <td><a href="{{ route('center.bookings.details', $booking) }}">{{ $booking->booking_reference_no }}</a></td>
              <td>{{ $booking->patient->name }}</td>
              <td>{{ $booking->payment_ref ? $booking->payment_ref : 'N/A' }}</td>
              <td>@if($booking->paid_at)@dateFormat($booking->paid_at) @else N/A @endif</td>
              <td>{{ config('telemed.mode_of_payment')[$booking->mode_of_payment] }}</td>
              @if(request('center'))
                  @forelse($booking->bookingCenters as $center)
                      @if($booking->mode_of_payment == 'credit_card')
                          <td class="price">&#8369;{{ number_format($center->amount_paid, 2) }}</td>
                      @else
                          <td class="price">&#8369;{{ number_format($center->center_discounted_totalAmount, 2) }}</td>
                      @endif
                  @empty
                  @endforelse
              @else
                  @if($booking->mode_of_payment == 'credit_card')
                      <td class="price">&#8369;{{ number_format($booking->amount_paid, 2)  }}</td>
                  @else
                      <td class="price">&#8369;{{ number_format($booking->discounted_total_amount, 2)  }}</td>
                  @endif
              @endif
          </tr>
          @endforeach
          <tr>
              <td colspan="5"></td>
              <td class="price"><b>Total: </b> <span>&#8369; {{ number_format($total, 2) }}</span></td>
          </tr>
      @else
          <tr><td class="text-center" colspan="6">No records found.</td></tr>
      @endif
     </tbody>
  </table>
