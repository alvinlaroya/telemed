<table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col"><b>Reference #</b></th>
        <th scope="col"><b>Patient</b></th>
        <th scope="col"><b>Centers</b></th>
        <th scope="col"><b>Status</b></th>
        <th scope="col"><b>Mode of Payment</b></th>
      </tr>
    </thead>
    <tbody>
      @if(count($bookings) > 0)
          @foreach($bookings as $booking)
              <?php $centers = $booking->bookingCenters ?>
          <tr>
              <td><a href="{{ route('center.bookings.details', $booking) }}">{{ $booking->booking_reference_no }}</a></td>
              <td>{{ $booking->patient->name }}</td>
              <td>
                  <ul>
                      @forelse($centers as $center)
                          @if($center->available_date->format('m/d/Y') == request('date'))
                          <li>
                              <label><b>{{ $center->name }}</b>
                                  <span class="badge badge-info {{ $center->status ?? $center->status }}">
                                      {{ ucfirst($center->status ?? $center->status) }}
                                  </span>
                                  <p style="margin-bottom: 0;">Scheduled Date: @dateFormat($center->available_date)</p>
                              </label>
                              @if($center->bookingServices)
                                  <ul style="padding-left: 10px;">
                                      @foreach($center->bookingServices as $services)
                                          <li>{{ $services->name }}</li>
                                      @endforeach
                                  </ul>
                              @endif
                          </li>
                          @elseif(request('date') == null)
                          <li>
                              <label><b>{{ $center->name }}</b>
                                  <span class="badge badge-info {{ $center->status ?? $center->status }}">
                                      {{ ucfirst($center->status ?? $center->status) }}
                                  </span>
                                  <p style="margin-bottom: 0;">Scheduled Date: @dateFormat($center->available_date)</p>
                              </label>
                              @if($center->bookingServices)
                                  <ul style="padding-left: 10px;">
                                      @foreach($center->bookingServices as $services)
                                          <li>{{ $services->name }}</li>
                                      @endforeach
                                  </ul>
                              @endif
                          </li>
                          @endif
                      @empty
                      @endforelse
                  </ul>
              </td>
              <td><span class="badge {{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
              <td>{{ config('telemed.mode_of_payment')[$booking->mode_of_payment] }}</td>
          </tr>
          @endforeach
      @else
          <tr><td class="text-center" colspan="5">No records found.</td></tr>
      @endif
     </tbody>
  </table>
